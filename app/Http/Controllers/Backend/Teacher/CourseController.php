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
use App\Models\StudentClass;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', Auth::id())->withCount('students')->get();
        return view('backend.teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.courses.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
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
        if ($course->teacher_id !== Auth::id()) abort(403);
        
        $course->load('subjects.topics.contents.quiz');
        $quizzes = Quiz::where('teacher_id', Auth::id())->get();
        return view('backend.teacher.courses.show', compact('course', 'quizzes'));
    }

    public function addSubject(Request $request, Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);

        $request->validate(['title' => 'required|string|max:255']);
        $course->subjects()->create(['title' => $request->title, 'order' => $course->subjects()->count() + 1]);
        return back()->with('success', 'Subject added.');
    }

    public function addTopic(Request $request, Subject $subject)
    {
        if ($subject->course->teacher_id !== Auth::id()) abort(403);

        $request->validate(['title' => 'required|string|max:255']);
        $subject->topics()->create(['title' => $request->title, 'order' => $subject->topics()->count() + 1]);
        return back()->with('success', 'Topic added.');
    }

    public function addContent(Request $request, Topic $topic)
    {
        if ($topic->subject->course->teacher_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'type' => 'required|in:note,video,test',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'quiz_id' => 'nullable|exists:quizzes,id',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp,gif|max:10240', // 10MB Max PDF/Image
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment_path'] = $path;
        }

        $validated['order'] = $topic->contents()->count() + 1;
        $topic->contents()->create($validated);
        
        return back()->with('success', 'Content added to topic.');
    }

    public function updateContent(Request $request, Content $content)
    {
        // Check ownership through course
        if ($content->topic->subject->course->teacher_id !== Auth::id()) abort(403);

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

    public function edit(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.courses.edit', compact('course', 'classes'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update($validated);

        return redirect()->route('teacher.courses.index')->with('success', 'Course updated successfully.');
    }

    public function publish(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        $course->update(['status' => 'published']);
        return back()->with('success', 'Course published successfully!');
    }

    public function unpublish(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        $course->update(['status' => 'draft']);
        return back()->with('success', 'Course moved to draft.');
    }

    public function destroy(Course $course)
    {
        if ($course->teacher_id !== Auth::id()) abort(403);
        $course->delete();
        return redirect()->route('teacher.courses.index')->with('success', 'Course deleted.');
    }

    public function updateSubject(Request $request, Subject $subject)
    {
        if ($subject->course->teacher_id !== Auth::id()) abort(403);
        $request->validate(['title' => 'required|string|max:255']);
        $subject->update(['title' => $request->title]);
        return back()->with('success', 'Subject updated.');
    }

    public function deleteSubject(Subject $subject)
    {
        if ($subject->course->teacher_id !== Auth::id()) abort(403);
        $subject->delete();
        return back()->with('success', 'Subject deleted.');
    }

    public function updateTopic(Request $request, Topic $topic)
    {
        if ($topic->subject->course->teacher_id !== Auth::id()) abort(403);
        $request->validate(['title' => 'required|string|max:255']);
        $topic->update(['title' => $request->title]);
        return back()->with('success', 'Topic updated.');
    }

    public function deleteTopic(Topic $topic)
    {
        if ($topic->subject->course->teacher_id !== Auth::id()) abort(403);
        $topic->delete();
        return back()->with('success', 'Topic deleted.');
    }

    public function deleteContent(Content $content)
    {
        if ($content->topic->subject->course->teacher_id !== Auth::id()) abort(403);
        $content->delete();
        return back()->with('success', 'Content deleted.');
    }
}
