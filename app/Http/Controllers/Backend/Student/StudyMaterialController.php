<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = StudyMaterial::forStudent($user);

        if ($request->has('category') && in_array($request->category, ['note', 'pdf', 'book', 'video', 'other'])) {
            $query->where('category', $request->category);
        }

        $materials = $query->latest()->paginate(15);
        
        // Fetch Academy LMS Files based on category
        $lmsQuery = \App\Models\Content::whereHas('topic.subject.course', function($q) use ($user) {
                $q->where('status', 'published')
                  ->where('class_id', $user->class_id);
            });

        if ($request->category === 'pdf' || $request->category === 'note') {
            $lmsQuery->whereNotNull('attachment_path');
        } elseif ($request->category === 'video') {
            $lmsQuery->where('type', 'video');
        } else {
            $lmsQuery->where(function($q) {
                $q->whereNotNull('attachment_path')->orWhere('type', 'video');
            });
        }

        $lmsFiles = $lmsQuery->latest()->get();

        return view('backend.student.study_materials.index', compact('materials', 'lmsFiles'));
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
