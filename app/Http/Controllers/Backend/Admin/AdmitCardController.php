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
            'instructions' => 'nullable|string'
        ]);

        AdmitCard::create($validated);

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
        
        // Pass data to a stripped-down PDF view
        $pdf = Pdf::loadView('backend.admin.admit_cards.pdf', compact('admitCard', 'siteSettings'));
        
        return $pdf->download('Admit_Card_' . $admitCard->roll_no . '.pdf');
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
            'exam_center' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'instructions' => 'nullable|string'
        ]);

        $quiz = \App\Models\Quiz::findOrFail($validated['quiz_id']);
        
        $enrollments = \App\Models\QuizEnrollment::where('quiz_id', $quiz->id)
            ->where('status', 'active')
            ->with('student.studentClass')
            ->get();

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
            ]);

            $generatedCount++;
        }

        $msg = "Successfully generated {$generatedCount} admit cards.";
        if ($skippedCount > 0) {
            $msg .= " Skipped {$skippedCount} students who already have admit cards for this exam.";
        }

        return redirect()->route('admin.admit-cards.index')->with('success', $msg);
    }

    public function destroy(AdmitCard $admitCard)
    {
        $admitCard->delete();
        
        return redirect()->route('admin.admit-cards.index')->with('success', 'Admit Card deleted successfully.');
    }
}
