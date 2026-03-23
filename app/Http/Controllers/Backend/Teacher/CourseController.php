<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Content;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', Auth::id())->withCount('students')->get();
        return view('backend.teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('backend.teacher.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['teacher_id'] = Auth::id();
        $validated['status'] = 'draft';

        $course = Course::create($validated);

        return redirect()->route('teacher.courses.show', $course)->with('success', 'Course created successfully. Now add subjects and topics.');
    }

    public function show(Course $course)
    {
        $course->load('subjects.topics.contents.quiz');
        $quizzes = Quiz::where('teacher_id', Auth::id())->get();
        return view('backend.teacher.courses.show', compact('course', 'quizzes'));
    }

    public function addSubject(Request $request, Course $course)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $course->subjects()->create(['title' => $request->title, 'order' => $course->subjects()->count() + 1]);
        return back()->with('success', 'Subject added.');
    }

    public function addTopic(Request $request, Subject $subject)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $subject->topics()->create(['title' => $request->title, 'order' => $subject->topics()->count() + 1]);
        return back()->with('success', 'Topic added.');
    }

    public function addContent(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'type' => 'required|in:note,video,test',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'quiz_id' => 'nullable|exists:quizzes,id',
        ]);

        $validated['order'] = $topic->contents()->count() + 1;
        $topic->contents()->create($validated);
        
        return back()->with('success', 'Content added to topic.');
    }
}
