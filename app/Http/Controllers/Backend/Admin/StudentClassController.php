<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentClassController extends Controller
{
    public function index()
    {
        $classes = StudentClass::withCount(['students', 'quizzes'])->latest()->get();
        return view('backend.admin.student_classes.index', compact('classes'));
    }

    public function create()
    {
        return view('backend.admin.student_classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:student_classes,name',
            'status' => 'required|in:active,inactive',
        ]);

        StudentClass::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.student-classes.index')->with('success', 'Class created successfully.');
    }

    public function edit(StudentClass $studentClass)
    {
        return view('backend.admin.student_classes.edit', compact('studentClass'));
    }

    public function update(Request $request, StudentClass $studentClass)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:student_classes,name,' . $studentClass->id,
            'status' => 'required|in:active,inactive',
        ]);

        $studentClass->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.student-classes.index')->with('success', 'Class updated successfully.');
    }

    public function toggleStatus(StudentClass $studentClass)
    {
        $newStatus = $studentClass->status === 'active' ? 'inactive' : 'active';
        $studentClass->update(['status' => $newStatus]);
        return back()->with('success', 'Status updated successfully.');
    }

    public function destroy(StudentClass $studentClass)
    {
        if ($studentClass->students()->count() > 0 || $studentClass->quizzes()->count() > 0) {
            return back()->with('error', 'Cannot delete class with active students or quizzes assigned.');
        }

        $studentClass->delete();
        return redirect()->route('admin.student-classes.index')->with('success', 'Class deleted successfully.');
    }
}
