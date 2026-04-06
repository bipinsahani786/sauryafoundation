<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::where('teacher_id', auth()->id())->latest()->paginate(15);
        return view('backend.teacher.study_materials.index', compact('materials'));
    }

    public function create()
    {
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.study_materials.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:note,pdf,book,other',
            'class_id' => 'nullable|exists:student_classes,id',
            'is_global' => 'nullable|boolean',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('study_materials', $filename, 'local');
            $validated['file_path'] = $path;
        }

        $validated['teacher_id'] = auth()->id();
        $validated['is_global'] = $request->has('is_global');

        StudyMaterial::create($validated);

        return redirect()->route('teacher.study-materials.index')->with('success', 'Study material uploaded successfully.');
    }

    public function edit(StudyMaterial $studyMaterial)
    {
        if ($studyMaterial->teacher_id !== auth()->id()) abort(403);
        $classes = StudentClass::where('status', 'active')->get();
        return view('backend.teacher.study_materials.edit', compact('studyMaterial', 'classes'));
    }

    public function update(Request $request, StudyMaterial $studyMaterial)
    {
        if ($studyMaterial->teacher_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:note,pdf,book,other',
            'class_id' => 'nullable|exists:student_classes,id',
            'is_global' => 'nullable|boolean',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:20480',
        ]);

        if ($request->hasFile('file')) {
            if (Storage::disk('local')->exists($studyMaterial->file_path)) {
                Storage::disk('local')->delete($studyMaterial->file_path);
            }
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('study_materials', $filename, 'local');
            $validated['file_path'] = $path;
        }

        $validated['is_global'] = $request->has('is_global');
        $studyMaterial->update($validated);

        return redirect()->route('teacher.study-materials.index')->with('success', 'Study material updated.');
    }

    public function destroy(StudyMaterial $studyMaterial)
    {
        if ($studyMaterial->teacher_id !== auth()->id()) abort(403);
        if (Storage::disk('local')->exists($studyMaterial->file_path)) {
            Storage::disk('local')->delete($studyMaterial->file_path);
        }
        $studyMaterial->delete();
        return back()->with('success', 'Study material deleted.');
    }

    public function toggleStatus(StudyMaterial $studyMaterial)
    {
        if ($studyMaterial->teacher_id !== auth()->id()) abort(403);
        $studyMaterial->update([
            'status' => $studyMaterial->status === 'active' ? 'inactive' : 'active'
        ]);
        return back()->with('success', 'Status updated.');
    }
}
