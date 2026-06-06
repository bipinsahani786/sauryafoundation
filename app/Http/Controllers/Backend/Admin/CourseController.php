<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Content;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentClass;

class CourseController extends Controller
{
    public function index()
    {
        // Admin sees all courses
        $courses = Course::with(['teacher'])->withCount('students')->latest()->get();
        return view('backend.admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.admin.courses.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['teacher_id'] = Auth::id(); // Admin is the creator
        $validated['status'] = 'draft';
        $validated['is_global'] = false; // Always false for admin courses now

        $course = Course::create($validated);

        return redirect()->route('admin.courses.show', $course)->with('success', 'Global course created successfully. Now add subjects and topics.');
    }

    public function show(Course $course)
    {
        $course->load('subjects.topics.contents.quiz');
        // Admin can attach any quiz or global quizzes
        $quizzes = Quiz::where('is_global', true)->orWhere('teacher_id', Auth::id())->get();
        return view('backend.admin.courses.show', compact('course', 'quizzes'));
    }

    public function edit(Course $course)
    {
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.admin.courses.edit', compact('course', 'classes'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['is_global'] = false;

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
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

    public function updateSubject(Request $request, Subject $subject)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $subject->update(['title' => $request->title]);
        return back()->with('success', 'Subject updated.');
    }

    public function deleteSubject(Subject $subject)
    {
        $subject->delete();
        return back()->with('success', 'Subject deleted.');
    }

    public function updateTopic(Request $request, Topic $topic)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $topic->update(['title' => $request->title]);
        return back()->with('success', 'Topic updated.');
    }

    public function deleteTopic(Topic $topic)
    {
        $topic->delete();
        return back()->with('success', 'Topic deleted.');
    }

    public function addContent(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'type' => 'required|in:note,video,test',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'quiz_id' => 'nullable|exists:quizzes,id',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp,gif|max:10240',
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment_path'] = $path;
        }

        $validated['order'] = $topic->contents()->count() + 1;
        $topic->contents()->create($validated);
        
        return back()->with('success', 'Content added.');
    }

    public function updateContent(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'quiz_id' => 'nullable|exists:quizzes,id',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp,gif|max:10240',
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment_path'] = $path;
        }

        $content->update($validated);
        return back()->with('success', 'Content updated.');
    }

    public function publish(Course $course)
    {
        $course->update(['status' => 'published']);
        return back()->with('success', 'Course published.');
    }

    public function deleteContent(Content $content)
    {
        $content->delete();
        return back()->with('success', 'Content deleted.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted.');
    }
}
