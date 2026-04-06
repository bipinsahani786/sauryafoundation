<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::forStudent(auth()->user())->latest()->paginate(15);
        return view('backend.student.study_materials.index', compact('materials'));
    }

    public function download(StudyMaterial $studyMaterial)
    {
        // Security Check: Verify student has access to this file
        $hasAccess = StudyMaterial::forStudent(auth()->user())->where('id', $studyMaterial->id)->exists();

        if (!$hasAccess) {
            abort(403, 'Unauthorized access to study material.');
        }

        if (!Storage::disk('local')->exists($studyMaterial->file_path)) {
            abort(404, 'File not found on secure server.');
        }

        return Storage::disk('local')->download($studyMaterial->file_path, $studyMaterial->title . '.' . pathinfo($studyMaterial->file_path, PATHINFO_EXTENSION));
    }
}
