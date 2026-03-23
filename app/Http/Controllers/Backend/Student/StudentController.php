<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $stats = [
            'total_exams' => Quiz::where('status', 'published')
                ->where('teacher_id', auth()->user()->teacher_id)
                ->count(),
            'attempted_exams' => auth()->user()->quizAttempts()->count(),
            'average_score' => auth()->user()->quizAttempts()->avg('score') ?? 0,
            'courses_enrolled' => auth()->user()->enrolledCourses()->count(),
            'lessons_completed' => auth()->user()->contentCompletions()->count(),
        ];

        $upcoming_exams = Quiz::where('status', 'published')
            ->where('teacher_id', auth()->user()->teacher_id)
            ->where('expires_at', '>', now())
            ->latest()
            ->take(5)
            ->get();

        return view('backend.student.dashboard', compact('stats', 'upcoming_exams'));
    }

    public function exams()
    {
        $quizzes = Quiz::where('teacher_id', auth()->user()->teacher_id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('backend.student.exams.index', compact('quizzes'));
    }

    public function showExam(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->user()->teacher_id) abort(403);
        return view('backend.student.exams.show', compact('quiz'));
    }

    public function startExam(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->user()->teacher_id) abort(403);

        // Check attempt limit
        $completedCount = auth()->user()->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->where('status', 'completed')
            ->count();
        
        if ($quiz->attempts_limit > 0 && $completedCount >= $quiz->attempts_limit) {
            return back()->with('error', 'You have reached the maximum number of attempts for this exam.');
        }

        // Check if already blocked from this quiz
        $isBlocked = auth()->user()->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->where('is_blocked', true)
            ->exists();

        if ($isBlocked) {
            return back()->with('error', 'You are blocked from this exam due to a security breach.');
        }

        // Check for existing ongoing attempt
        $attempt = QuizAttempt::firstOrCreate([
            'student_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'status' => 'ongoing',
        ], [
            'started_at' => now(),
        ]);

        return redirect()->route('student.exams.take', $quiz->id);
    }

    public function takeExam(Quiz $quiz)
    {
        if ($quiz->teacher_id !== auth()->user()->teacher_id) abort(403);
        
        $attempt = QuizAttempt::where('student_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->where('status', 'ongoing')
            ->first();

        if (!$attempt) {
            return redirect()->route('student.exams.show', $quiz->id)->with('error', 'No active session found. Please start the exam again.');
        }

        // Calculate Remaining Time
        $endTime = $attempt->started_at->addMinutes($quiz->duration_minutes);
        $remainingSeconds = max(0, now()->diffInSeconds($endTime, false));

        if ($remainingSeconds <= 0) {
            return $this->autoSubmit($attempt);
        }

        $questions = $quiz->questions()->get();
        return view('backend.student.exams.take', compact('quiz', 'questions', 'remainingSeconds'));
    }

    public function submitExam(Request $request, Quiz $quiz)
    {
        $attempt = QuizAttempt::where('student_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->where('status', 'ongoing')
            ->first();

        if (!$attempt) {
            // Check if they already submitted it recently
            $lastAttempt = QuizAttempt::where('student_id', auth()->id())
                ->where('quiz_id', $quiz->id)
                ->latest()
                ->first();
            
            if ($lastAttempt && $lastAttempt->status === 'completed') {
                return redirect()->route('student.results.show', $lastAttempt->id);
            }

            return redirect()->route('student.exams')->with('error', 'Session expired or not found.');
        }

        $score = 0;
        $totalMarks = 0;
        $answers = $request->input('answers', []);

        foreach ($quiz->questions as $question) {
            $totalMarks += $question->marks;
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_option) {
                $score += $question->marks;
            }
        }

        $attempt->update([
            'score' => $score,
            'total_marks' => $totalMarks,
            'completed_at' => now(),
            'status' => 'completed',
            'time_taken_seconds' => now()->diffInSeconds($attempt->started_at),
        ]);

        return redirect()->route('student.results.show', $attempt->id);
    }

    public function showResult(QuizAttempt $attempt)
    {
        if ($attempt->student_id !== auth()->id()) abort(403);
        
        $rank = QuizAttempt::where('quiz_id', $attempt->quiz_id)
            ->where('status', 'completed')
            ->where('score', '>', $attempt->score)
            ->count() + 1;
            
        return view('backend.student.exams.result', compact('attempt', 'rank'));
    }

    public function courses()
    {
        $courses = Quiz::where('status', 'published')->count(); // Just for context, actually use Course model
        $courses = \App\Models\Course::where('status', 'published')->withCount('students')->get();
        $enrolledIds = auth()->user()->enrolledCourses()->pluck('courses.id')->toArray();
        return view('backend.student.courses.index', compact('courses', 'enrolledIds'));
    }

    public function showCourse(\App\Models\Course $course)
    {
        $isEnrolled = auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists();
        
        if (!$isEnrolled) {
            return view('backend.student.courses.landing', compact('course'));
        }

        $course->load('subjects.topics.contents.quiz');
        return view('backend.student.courses.viewer', compact('course'));
    }

    public function enroll(\App\Models\Course $course)
    {
        auth()->user()->enrolledCourses()->syncWithoutDetaching([$course->id]);
        return redirect()->route('student.courses.show', $course)->with('success', 'Enrolled successfully!');
    }

    public function completeContent(\App\Models\Content $content)
    {
        auth()->user()->contentCompletions()->firstOrCreate(['content_id' => $content->id]);
        return response()->json(['success' => true]);
    }

    public function reportBreach(Request $request, Quiz $quiz)
    {
        $attempt = QuizAttempt::where('student_id', auth()->id())
            ->where('quiz_id', $quiz->id)
            ->where('status', 'ongoing')
            ->first();

        if ($attempt) {
            $attempt->update([
                'is_blocked' => true,
                'block_reason' => $request->reason ?? 'Security Breach: Tab Switch / Fullscreen Exit',
                'status' => 'failed',
                'completed_at' => now(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Student blocked due to security breach.']);
    }

    private function autoSubmit($attempt)
    {
        $attempt->update([
            'status' => 'completed',
            'completed_at' => now(),
            'score' => 0, // Or calculate based on saved drafts if any
        ]);
        return redirect()->route('student.results.show', $attempt->id)->with('warning', 'Exam time expired. Auto-submitted.');
    }
}
