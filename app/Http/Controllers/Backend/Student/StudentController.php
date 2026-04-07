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
        $user = auth()->user();
        $classId = $user->class_id;

        $stats = [
            'total_exams' => Quiz::where('status', 'published')
                ->where(function($q) use ($user) {
                    $q->where('is_global', true)
                      ->orWhere(function($sub) use ($user) {
                          $sub->where('teacher_id', $user->teacher_id)
                              ->whereHas('studentClasses', function($sq) use ($user) {
                                  $sq->where('student_classes.id', $user->class_id);
                              });
                      });
                })
                ->count(),
            'attempted_exams' => $user->quizAttempts()->count(),
            'average_score' => $user->quizAttempts()->avg('score') ?? 0,
            'courses_enrolled' => $user->enrolledCourses()->count(),
            'lessons_completed' => $user->contentCompletions()->count(),
        ];

        $upcoming_exams = Quiz::where('status', 'published')
            ->where(function($q) use ($user) {
                $q->where('is_global', true)
                  ->orWhere(function($sub) use ($user) {
                      $sub->where('teacher_id', $user->teacher_id)
                          ->whereHas('studentClasses', function($sq) use ($user) {
                              $sq->where('student_classes.id', $user->class_id);
                          });
                  });
            })
            ->where('expires_at', '>', now())
            ->latest()
            ->take(5)
            ->get();

        $banners = \App\Models\Banner::where('is_active', true)->where('type', 'student')->orderBy('order')->get();
        $recent_materials = \App\Models\StudyMaterial::forStudent($user)->latest()->take(5)->get();

        return view('backend.student.dashboard', compact('stats', 'upcoming_exams', 'banners', 'recent_materials'));
    }

    public function exams()
    {
        $user = auth()->user();
        $classId = $user->class_id;

        $allQuizzes = Quiz::where('status', 'published')
            ->where(function($q) use ($user) {
                $q->where('is_global', true)
                  ->orWhere(function($sub) use ($user) {
                      $sub->where('teacher_id', $user->teacher_id)
                          ->whereHas('studentClasses', function($sq) use ($user) {
                              $sq->where('student_classes.id', $user->class_id);
                          });
                  });
            })
            ->withCount(['attempts as quiz_attempts_count' => function($query) {
                $query->where('student_id', auth()->id());
            }])
            ->latest()
            ->get();
            
        // Categorize
        $liveExams = $allQuizzes->filter(function($q) {
            return $q->start_time !== null;
        });

        $practiceQuizzes = $allQuizzes->filter(function($q) {
            return $q->start_time === null;
        });
            
        return view('backend.student.exams.index', compact('liveExams', 'practiceQuizzes'));
    }

    public function showExam(Quiz $quiz)
    {
        // Check if student has access
        $user = auth()->user();
        if (!$quiz->is_global && ($quiz->teacher_id !== $user->teacher_id || !$quiz->studentClasses()->where('student_class_id', $user->class_id)->exists())) {
             abort(403);
        }
        
        $isEnrolled = $user->quizEnrollments()->where('quiz_id', $quiz->id)->exists();
        return view('backend.student.exams.show', compact('quiz', 'isEnrolled'));
    }

    public function enrollExam(Quiz $quiz)
    {
        $user = auth()->user();
        
        if (!$quiz->is_global && $quiz->teacher_id !== $user->teacher_id) {
             abort(403);
        }

        // Timing Check for Live Exams
        if ($quiz->end_time && $quiz->end_time->isPast()) {
            return back()->with('error', 'This exam has expired and is no longer available for enrollment.');
        }

        if ($user->quizEnrollments()->where('quiz_id', $quiz->id)->exists()) {
            return back()->with('info', 'You are already enrolled.');
        }

        if ($quiz->parent_id && $quiz->level_number > 1) {
            return back()->with('error', 'You cannot directly enroll in advanced levels. You must qualify from previous levels.');
        }

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($user, $quiz) {
                // Lock the user record to prevent race conditions on wallet_balance
                $user->lockForUpdate()->find($user->id);

                if ($quiz->price > 0) {
                    if ($user->wallet_balance < $quiz->price) {
                        throw new \Exception('Insufficient wallet balance.');
                    }
                    $user->withdraw($quiz->price, Quiz::class, $quiz->id, 'Enrollment for Quiz: ' . $quiz->title);
                }

                $enrollment = $user->quizEnrollments()->create([
                    'quiz_id' => $quiz->id,
                    'paid_amount' => $quiz->price,
                    'status' => 'active'
                ]);

                if ($quiz->price > 0) {
                    (new \App\Services\CommissionService())->distribute($enrollment, 'quiz');
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Enrollment failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Enrolled successfully! You can now start the exam.');
    }

    public function startExam(Quiz $quiz)
    {
        $user = auth()->user();
        
        // Timing Check for Live Exams
        if ($quiz->start_time) {
            if ($quiz->start_time->isFuture()) {
                return back()->with('error', 'This exam has not started yet. Please wait for the scheduled time.');
            }
            if ($quiz->end_time && $quiz->end_time->isPast()) {
                return back()->with('error', 'This exam window has closed. You can no longer start it.');
            }
        }

        // Ensure enrolled
        if (!$user->quizEnrollments()->where('quiz_id', $quiz->id)->exists()) {
            return back()->with('error', 'You must enroll first.');
        }

        // Check attempt limit
        $completedCount = auth()->user()->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->where('status', 'completed')
            ->count();
        
        if (!$quiz->is_practice_set && $quiz->attempts_limit > 0 && $completedCount >= $quiz->attempts_limit) {
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
        $user = auth()->user();
        
        if (!$user->quizEnrollments()->where('quiz_id', $quiz->id)->exists()) {
            abort(403);
        }
        
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

        $questions = $quiz->is_practice_set 
            ? $quiz->questions()->inRandomOrder()->get() 
            : $quiz->questions()->get();
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
            ->where('is_blocked', false)
            ->where(function ($query) use ($attempt) {
                $query->where('score', '>', $attempt->score)
                    ->orWhere(function ($q) use ($attempt) {
                        $q->where('score', $attempt->score)
                            ->where('time_taken_seconds', '<', $attempt->time_taken_seconds);
                    });
            })
            ->count() + 1;
            
        $leaderboard = QuizAttempt::where('quiz_id', $attempt->quiz_id)
            ->where('status', 'completed')
            ->where('is_blocked', false)
            ->whereIn('id', function($query) use ($attempt) {
                $query->selectRaw('MAX(id)')
                    ->from('quiz_attempts')
                    ->where('quiz_id', $attempt->quiz_id)
                    ->where('status', 'completed')
                    ->where('is_blocked', false)
                    ->groupBy('student_id');
            })
            ->with('student')
            ->orderByDesc('score')
            ->orderBy('time_taken_seconds')
            ->take(10)
            ->get();
            
        return view('backend.student.exams.result', compact('attempt', 'rank', 'leaderboard'));
    }

    public function courses()
    {
        $user = auth()->user();
        $courses = \App\Models\Course::where('status', 'published')
            ->where(function($q) use ($user) {
                $q->where('is_global', true)
                  ->orWhere(function($sub) use ($user) {
                      $sub->where('teacher_id', $user->teacher_id)
                          ->where('class_id', $user->class_id);
                  });
            })
            ->withCount('students')
            ->get();
        $enrolledIds = $user->enrolledCourses()->pluck('courses.id')->toArray();
        return view('backend.student.courses.index', compact('courses', 'enrolledIds'));
    }

    public function showCourse(\App\Models\Course $course)
    {
        $user = auth()->user();
        if (!$course->is_global && ($course->teacher_id !== $user->teacher_id || $course->class_id != $user->class_id)) {
             abort(403);
        }
        
        $isEnrolled = $user->enrolledCourses()->where('course_id', $course->id)->exists();
        
        if (!$isEnrolled) {
            return view('backend.student.courses.landing', compact('course'));
        }

        $course->load('subjects.topics.contents.quiz');
        return view('backend.student.courses.viewer', compact('course'));
    }

    public function enroll(\App\Models\Course $course)
    {
        $user = auth()->user();
        
        if (!$course->is_global && $course->teacher_id !== $user->teacher_id) {
             abort(403);
        }

        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
             return back()->with('info', 'You are already enrolled in this course.');
        }

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($user, $course) {
                // Lock for concurrency safety
                $user->lockForUpdate()->find($user->id);

                if ($course->price > 0) {
                    if ($user->wallet_balance < $course->price) {
                        throw new \Exception('Insufficient wallet balance.');
                    }
                    $user->withdraw($course->price, \App\Models\Course::class, $course->id, 'Enrollment for Course: ' . $course->title);
                }

                // Enroll
                $user->enrolledCourses()->syncWithoutDetaching([$course->id]);

                // Commissions
                if ($course->price > 0) {
                    (new \App\Services\CommissionService())->distribute($course, 'course', $user);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Course enrollment failed: ' . $e->getMessage());
        }

        return redirect()->route('student.courses.show', $course)->with('success', 'Enrolled successfully!');
    }

    public function completeContent(\App\Models\Content $content)
    {
        auth()->user()->contentCompletions()->firstOrCreate(['content_id' => $content->id]);
        return response()->json(['success' => true]);
    }

    public function reportBreach(Request $request, Quiz $quiz)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

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
            
            return response()->json([
                'success' => true, 
                'redirect' => route('student.results.show', $attempt->id),
                'message' => 'Security breach detected. Exam terminated.'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No active session found.']);
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

    public function wallet()
    {
        $transactions = auth()->user()->transactions()->latest()->paginate(20);
        return view('backend.student.wallet.index', compact('transactions'));
    }
}
