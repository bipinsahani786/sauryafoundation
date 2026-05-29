<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::whereNull('teacher_id')->latest()->paginate(15);
        return view('backend.admin.study_materials.index', compact('materials'));
    }

    public function create()
    {
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.study_materials.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:note,pdf,book,other',
            'class_id' => 'nullable|exists:student_classes,id',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:20480',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('study_materials', $filename, 'local');
            $validated['file_path'] = $path;
        }

        $validated['is_global'] = true;
        $validated['teacher_id'] = null; // System/Admin material

        StudyMaterial::create($validated);

        return redirect()->route('admin.study-materials.index')->with('success', 'Study material uploaded successfully.');
    }

    public function edit(StudyMaterial $studyMaterial)
    {
        $classes = \App\Models\StudentClass::where('status', 'active')->get();
        return view('backend.admin.study_materials.edit', compact('studyMaterial', 'classes'));
    }

    public function update(Request $request, StudyMaterial $studyMaterial)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:note,pdf,book,other',
            'class_id' => 'nullable|exists:student_classes,id',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:20480',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::disk('local')->exists($studyMaterial->file_path)) {
                Storage::disk('local')->delete($studyMaterial->file_path);
            }
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('study_materials', $filename, 'local');
            $validated['file_path'] = $path;
        }

        $studyMaterial->update($validated);

        return redirect()->route('admin.study-materials.index')->with('success', 'Study material updated.');
    }

    public function destroy(StudyMaterial $studyMaterial)
    {
        if (Storage::disk('local')->exists($studyMaterial->file_path)) {
            Storage::disk('local')->delete($studyMaterial->file_path);
        }
        $studyMaterial->delete();
        return back()->with('success', 'Study material deleted.');
    }

    public function toggleStatus(StudyMaterial $studyMaterial)
    {
        $studyMaterial->update([
            'status' => $studyMaterial->status === 'active' ? 'inactive' : 'active'
        ]);
        return back()->with('success', 'Status updated.');
    }
}
