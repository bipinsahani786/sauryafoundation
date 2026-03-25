<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => auth()->user()->students()->count(),
            'total_quizzes' => Quiz::where('teacher_id', auth()->id())->count(),
            'pending_approvals' => Quiz::where('teacher_id', auth()->id())->where('status', 'pending')->count(),
        ];
        
        $recent_quizzes = Quiz::where('teacher_id', auth()->id())->latest()->take(5)->get();
        
        return view('backend.teacher.dashboard', compact('stats', 'recent_quizzes'));
    }

    public function students()
    {
        $students = auth()->user()->students()->latest()->paginate(20);
        return view('backend.teacher.students.index', compact('students'));
    }

    public function addStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'teacher_id' => auth()->id(),
            'status' => 'active',
        ]);

        return back()->with('success', 'Student admitted successfully.');
    }

    public function studentProgress(\App\Models\User $student)
    {
        if ($student->teacher_id !== auth()->id()) abort(403);
        
        $enrolledCourses = $student->enrolledCourses()->with('subjects.topics.contents.quiz')->get();
        $completions = $student->contentCompletions()->pluck('content_id')->toArray();
        $quizAttempts = $student->quizAttempts()->with('quiz')->latest()->get();
        
        return view('backend.teacher.students.progress', compact('student', 'enrolledCourses', 'completions', 'quizAttempts'));
    }
}
