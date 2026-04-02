<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\StudentClass;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', auth()->id())
            ->withCount('enrollments')
            ->latest()
            ->paginate(15);
        return view('backend.admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $classes = StudentClass::where('status', 'active')->get();
        // Load only parent quizzes to attach as level if necessary
        $parentQuizzes = Quiz::where('is_contest', true)->get();
        return view('backend.admin.quizzes.create', compact('classes', 'parentQuizzes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'is_global' => 'nullable|boolean',
            'class_ids' => 'required_without:is_global|array',
            'class_ids.*' => 'exists:student_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'attempts_limit' => 'required|integer|min:0',
            'is_contest' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:quizzes,id',
            'level_number' => 'nullable|integer|min:1',
            'promotion_percentage' => 'nullable|integer|min:1|max:100',
            'winner_count' => 'nullable|integer|min:1',
            'is_practice_set' => 'nullable|boolean',
        ]);

        $status = $validated['price'] > 0 ? 'pending' : 'published';

        $quiz = Quiz::create([
            'teacher_id' => auth()->id(), // Admin is acting as creator
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'status' => $status,
            'duration_minutes' => $validated['duration_minutes'],
            'attempts_limit' => $validated['attempts_limit'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'expires_at' => $validated['end_time'] ?? null,
            'is_global' => $request->has('is_global'),
            'is_contest' => $request->has('is_contest'),
            'parent_id' => $validated['parent_id'] ?? null,
            'level_number' => $validated['level_number'] ?? null,
            'promotion_percentage' => $validated['promotion_percentage'] ?? null,
            'winner_count' => $validated['winner_count'] ?? null,
            'is_practice_set' => $request->has('is_practice_set'),
        ]);

        if (!$request->has('is_global') && isset($validated['class_ids'])) {
            $quiz->studentClasses()->sync($validated['class_ids']);
        }

        return redirect()->route('admin.quizzes.show', $quiz->id)->with('success', 'Quiz created successfully. Now add questions.');
    }

    public function show(Quiz $quiz)
    {
        $questions = $quiz->questions;
        return view('backend.admin.quizzes.show', compact('quiz', 'questions'));
    }

    public function addQuestion(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_0' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'correct_option' => 'required|integer|between:0,3',
            'marks' => 'required|integer|min:1',
        ]);

        $quiz->questions()->create([
            'question_text' => $validated['question_text'],
            'options' => [
                $validated['option_0'],
                $validated['option_1'],
                $validated['option_2'],
                $validated['option_3'],
            ],
            'correct_option' => $validated['correct_option'],
            'marks' => $validated['marks'],
        ]);

        return back()->with('success', 'Question added.');
    }

    public function results(Quiz $quiz)
    {
        $attempts = $quiz->attempts()->with('student')
            ->orderByDesc('score')
            ->orderBy('time_taken_seconds')
            ->get();

        $attemptedStudents = $attempts->unique('student_id')->count();
        $avgScore = $attempts->avg('score') ?? 0;
        $maxScore = $attempts->max('score') ?? 0;
        $successRate = $attempts->count() > 0 
            ? ($attempts->where('score', '>=', $quiz->questions()->sum('marks') * 0.4)->count() / $attempts->count()) * 100 
            : 0;
        $breaches = $attempts->where('is_blocked', true)->count();
        $totalStudents = $quiz->enrollments()->count();

        return view('backend.admin.quizzes.results', compact(
            'quiz', 
            'attempts', 
            'attemptedStudents', 
            'totalStudents',
            'avgScore', 
            'maxScore', 
            'successRate', 
            'breaches'
        ));
    }

    public function calculateAndPromote(Quiz $quiz)
    {
        if (!$quiz->promotion_percentage) {
            return back()->with('error', 'No promotion percentage set for this quiz.');
        }

        // Get the next level quiz
        $nextLevelQuiz = Quiz::where('parent_id', $quiz->parent_id ?? $quiz->id)
            ->where('level_number', ($quiz->level_number ?? 1) + 1)
            ->first();

        if (!$nextLevelQuiz) {
            return back()->with('warning', 'No next level found. This is likely the final level.');
        }

        // Get top unique student attempts
        $attempts = $quiz->attempts()
            ->where('status', 'completed')
            ->where('is_blocked', false)
            ->orderByDesc('score')
            ->orderBy('time_taken_seconds')
            ->get()
            ->unique('student_id');

        $totalQualifying = ceil($attempts->count() * ($quiz->promotion_percentage / 100));
        
        $promotedStudents = $attempts->take($totalQualifying)->pluck('student_id');

        $promotedCount = 0;
        foreach ($promotedStudents as $studentId) {
            \App\Models\QuizEnrollment::firstOrCreate([
                'student_id' => $studentId,
                'quiz_id' => $nextLevelQuiz->id,
            ], [
                'paid_amount' => 0, // Promotions are always free
                'status' => 'active'
            ]);
            $promotedCount++;
        }

        return back()->with('success', "Promotion complete: {$promotedCount} students moved to Level {$nextLevelQuiz->level_number}.");
    }

    public function edit(Quiz $quiz)
    {
        $classes = StudentClass::where('status', 'active')->get();
        $parentQuizzes = Quiz::where('is_contest', true)->where('id', '!=', $quiz->id)->get();
        $selectedClasses = $quiz->studentClasses->pluck('id')->toArray();
        return view('backend.admin.quizzes.edit', compact('quiz', 'classes', 'parentQuizzes', 'selectedClasses'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'is_global' => 'nullable|boolean',
            'class_ids' => 'required_without:is_global|array',
            'class_ids.*' => 'exists:student_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'attempts_limit' => 'required|integer|min:0',
            'is_contest' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:quizzes,id',
            'level_number' => 'nullable|integer|min:1',
            'promotion_percentage' => 'nullable|integer|min:1|max:100',
            'winner_count' => 'nullable|integer|min:1',
            'is_practice_set' => 'nullable|boolean',
        ]);

        $quiz->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'duration_minutes' => $validated['duration_minutes'],
            'attempts_limit' => $validated['attempts_limit'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'expires_at' => $validated['end_time'] ?? null,
            'is_global' => $request->has('is_global'),
            'is_contest' => $request->has('is_contest'),
            'parent_id' => $validated['parent_id'] ?? null,
            'level_number' => $validated['level_number'] ?? null,
            'promotion_percentage' => $validated['promotion_percentage'] ?? null,
            'winner_count' => $validated['winner_count'] ?? null,
            'is_practice_set' => $request->has('is_practice_set'),
        ]);

        if (!$request->has('is_global')) {
            $quiz->studentClasses()->sync($validated['class_ids']);
        } else {
            $quiz->studentClasses()->detach();
        }

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted.');
    }

    public function addBulkQuestions(Request $request, Quiz $quiz)
    {
        $request->validate([
            'upload_type' => 'required|in:csv,text',
        ]);

        $addedCount = 0;

        if ($request->upload_type === 'csv') {
            $request->validate(['csv_file' => 'required|mimes:csv,txt|max:2048']);
            $file = $request->file('csv_file');
            
            $handle = fopen($file->getRealPath(), "r");
            $header = fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) >= 6) { // Minimum Q, Opt1, Opt2, Opt3, Opt4, CorrectAns required
                    $quiz->questions()->create([
                        'question_text' => $data[0],
                        'options' => [$data[1], $data[2], $data[3], $data[4]],
                        'correct_option' => (int)$data[5],
                        'marks' => isset($data[6]) ? (int)$data[6] : 1,
                    ]);
                    $addedCount++;
                }
            }
            fclose($handle);
            
        } elseif ($request->upload_type === 'text') {
            $request->validate(['bulk_text' => 'required|string']);
            
            // Basic text parsing logic: split by double newlines or something.
            // Expected Format:
            // Q: Question text
            // A: Option 0
            // B: Option 1
            // C: Option 2
            // D: Option 3
            // Ans: A/B/C/D
            // Marks: 1
            $blocks = preg_split('/\n\s*\n/', trim($request->bulk_text));
            
            foreach ($blocks as $block) {
                $lines = explode("\n", str_replace("\r", "", trim($block)));
                if (count($lines) < 6) continue;
                
                $qText = preg_replace('/^Q:\s*/i', '', trim($lines[0]));
                $opt0 = preg_replace('/^A[:\.]\s*/i', '', trim($lines[1]));
                $opt1 = preg_replace('/^B[:\.]\s*/i', '', trim($lines[2]));
                $opt2 = preg_replace('/^C[:\.]\s*/i', '', trim($lines[3]));
                $opt3 = preg_replace('/^D[:\.]\s*/i', '', trim($lines[4]));
                
                $ansLine = trim($lines[5]);
                $ansChar = strtoupper(preg_replace('/^Ans[:\.]\s*/i', '', $ansLine));
                $correctMapping = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3];
                $correct = $correctMapping[$ansChar] ?? 0;
                
                $marks = 1;
                if (isset($lines[6])) {
                    $marksLine = trim($lines[6]);
                    $marksStr = preg_replace('/^Marks[:\.]\s*/i', '', $marksLine);
                    if (is_numeric($marksStr)) {
                        $marks = (int)$marksStr;
                    }
                }
                
                $quiz->questions()->create([
                    'question_text' => $qText,
                    'options' => [$opt0, $opt1, $opt2, $opt3],
                    'correct_option' => $correct,
                    'marks' => $marks,
                ]);
                $addedCount++;
            }
        }

        return back()->with('success', "Added {$addedCount} questions successfully.");
    }

    public function publish(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) abort(403);
        $quiz->update(['status' => 'published']);
        return back()->with('success', 'Exam has been published successfully.');
    }

    public function unpublish(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->id()) abort(403);
        $quiz->update(['status' => 'pending']);
        return back()->with('success', 'Exam has been unpublished successfully.');
    }

    public function downloadSampleCSV()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=sample_questions.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Question', 'Option A', 'Option B', 'Option C', 'Option D', 'Correct Option Index (0-3)', 'Marks'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Sample row
            fputcsv($file, [
                'What is the capital of India?', 
                'Mumbai', 
                'New Delhi', 
                'Pune', 
                'Goa', 
                '1', 
                '1'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function deleteQuestion(Question $question)
    {
        if ($question->quiz->teacher_id !== auth()->id()) abort(403);
        $question->delete();
        return back()->with('success', 'Question deleted successfully.');
    }
}
