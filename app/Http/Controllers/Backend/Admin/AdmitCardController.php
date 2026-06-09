<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdmitCard;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmitCardController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmitCard::with('user')->latest();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('roll_no', 'like', "%{$search}%")
                  ->orWhere('exam_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
        }
        
        $admitCards = $query->paginate(20)->withQueryString();
        
        return view('backend.admin.admit_cards.index', compact('admitCards'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->select('id', 'name', 'email')->get();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        
        // Generate a random roll number for suggestion
        $suggestedRollNo = 'R' . date('Y') . strtoupper(substr(uniqid(), -5));
        
        return view('backend.admin.admit_cards.create', compact('students', 'classes', 'suggestedRollNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_class' => 'nullable|string|max:255',
            'exam_name' => 'required|string|max:255',
            'roll_no' => 'required|string|max:255|unique:admit_cards',
            'exam_center' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'instructions' => 'nullable|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        if ($request->hasFile('header_image')) {
            $data['header_image'] = $request->file('header_image')->store('admit_card_headers', 'public');
        }

        AdmitCard::create($data);

        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card generated successfully.');
    }

    public function show(AdmitCard $admitCard)
    {
        // Load the relationship
        $admitCard->load('user');
        $siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
        
        return view('backend.admin.admit_cards.show', compact('admitCard', 'siteSettings'));
    }

    public function downloadPdf(AdmitCard $admitCard)
    {
        $admitCard->load('user');
        $siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
        
        return view('backend.admin.admit_cards.print', compact('admitCard', 'siteSettings'));
    }

    public function printBulk(Request $request)
    {
        $query = AdmitCard::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('roll_no', 'like', "%{$search}%")
                  ->orWhere('exam_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Only get approved admit cards (assuming all generated are 'approved', else filter here)
        $admitCards = $query->latest()->get();
        $siteSettings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view('backend.admin.admit_cards.print_bulk', compact('admitCards', 'siteSettings'));
    }

    public function bulkCreate()
    {
        $quizzes = \App\Models\Quiz::where('status', 'published')
            ->withCount(['enrollments as enrolled_count' => function ($query) {
                $query->where('status', 'active');
            }])
            ->get();

        return view('backend.admin.admit_cards.bulk_create', compact('quizzes'));
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'class_ids' => 'nullable|array',
            'class_ids.*' => 'exists:student_classes,id',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:users,id',
            'exam_center' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'instructions' => 'nullable|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $headerImagePath = null;
        if ($request->hasFile('header_image')) {
            $headerImagePath = $request->file('header_image')->store('admit_card_headers', 'public');
        }

        $quiz = \App\Models\Quiz::findOrFail($validated['quiz_id']);
        
        $query = \App\Models\QuizEnrollment::where('quiz_id', $quiz->id)
            ->where('status', 'active')
            ->with('student.studentClass');

        if (!empty($validated['class_ids'])) {
            $query->whereHas('student', function($q) use ($validated) {
                $q->whereIn('class_id', $validated['class_ids']);
            });
        }

        if (!empty($validated['student_ids'])) {
            $query->whereIn('student_id', $validated['student_ids']);
        }

        $enrollments = $query->get();

        if ($enrollments->isEmpty()) {
            return back()->with('error', 'No enrolled students found for the selected exam.');
        }

        $generatedCount = 0;
        $skippedCount = 0;

        foreach ($enrollments as $enrollment) {
            $student = $enrollment->student;
            
            if (!$student) {
                continue;
            }

            $exists = AdmitCard::where('user_id', $student->id)
                ->where('exam_name', $quiz->title)
                ->exists();

            if ($exists) {
                $skippedCount++;
                continue;
            }

            $year = date('Y');
            $random = strtoupper(substr(md5(uniqid()), 0, 4));
            $rollNo = 'R' . $year . $quiz->id . $student->id . $random;

            while (AdmitCard::where('roll_no', $rollNo)->exists()) {
                $random = strtoupper(substr(md5(uniqid()), 0, 4));
                $rollNo = 'R' . $year . $quiz->id . $student->id . $random;
            }

            AdmitCard::create([
                'user_id' => $student->id,
                'student_class' => $student->studentClass ? $student->studentClass->name : null,
                'exam_name' => $quiz->title,
                'roll_no' => $rollNo,
                'exam_center' => $validated['exam_center'],
                'exam_date' => $validated['exam_date'],
                'instructions' => $validated['instructions'] ?? "1. Please bring a valid photo ID.\n2. Do not bring any electronic devices into the examination hall.",
                'header_image' => $headerImagePath,
            ]);

            $generatedCount++;
        }

        $msg = "Successfully generated {$generatedCount} admit cards.";
        if ($skippedCount > 0) {
            $msg .= " Skipped {$skippedCount} students who already have admit cards for this exam.";
        }

        return redirect()->route('admin.admit-cards.index')->with('success', $msg);
    }

    public function edit(AdmitCard $admitCard)
    {
        $students = User::where('role', 'student')->select('id', 'name', 'email')->get();
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.admit_cards.edit', compact('admitCard', 'students', 'classes'));
    }

    public function update(Request $request, AdmitCard $admitCard)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'student_class' => 'nullable|string|max:255',
            'exam_name' => 'required|string|max:255',
            'roll_no' => 'required|string|max:255|unique:admit_cards,roll_no,' . $admitCard->id,
            'exam_center' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'instructions' => 'nullable|string',
            'header_image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        if ($request->hasFile('header_image')) {
            if ($admitCard->header_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($admitCard->header_image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($admitCard->header_image);
            }
            $data['header_image'] = $request->file('header_image')->store('admit_card_headers', 'public');
        }

        $admitCard->update($data);

        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card updated successfully.');
    }

    public function destroy(AdmitCard $admitCard)
    {
        $admitCard->delete();
        
        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card deleted successfully.');
    }

    public function getEnrolledStudents(Request $request)
    {
        $quizId = $request->quiz_id;
        $classIds = $request->input('class_ids', []);

        if (!$quizId) {
            return response()->json(['students' => [], 'classes' => []]);
        }

        $enrollments = \App\Models\QuizEnrollment::where('quiz_id', $quizId)
            ->where('status', 'active')
            ->with(['student.studentClass'])
            ->get();

        $students = collect();
        $classes = collect();

        foreach ($enrollments as $enrollment) {
            $student = $enrollment->student;
            if ($student) {
                // Collect class if exists
                if ($student->studentClass) {
                    $classes->push([
                        'id' => $student->studentClass->id,
                        'name' => $student->studentClass->name
                    ]);
                }

                // If classes are specified, filter students by class
                if (!empty($classIds) && !in_array($student->class_id, $classIds)) {
                    continue;
                }
                
                $students->push([
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'class_name' => $student->studentClass ? $student->studentClass->name : 'N/A'
                ]);
            }
        }

        return response()->json([
            'students' => $students->values(),
            'classes' => $classes->unique('id')->values()
        ]);
    }
}
