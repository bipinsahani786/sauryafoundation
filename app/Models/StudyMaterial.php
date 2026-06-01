<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_id',
        'title',
        'category',
        'description',
        'file_path',
        'is_global',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(\App\Models\User::class, 'teacher_id');
    }

    public function studentClass()
    {
        return $this->belongsTo(\App\Models\StudentClass::class, 'class_id');
    }

    /**
     * Scope for student visibility.
     */
    public function scopeForStudent($query, $user)
    {
        return $query->where('status', 'active')
            ->where(function($q) use ($user) {
                // Rule 1: Global Notes (for everyone)
                $q->where('is_global', true)
                  
                  // Rule 2: Notes for the student's specific class
                  ->orWhere(function($subQ) use ($user) {
                      $subQ->where('class_id', $user->class_id);
                      
                      // If the student has a teacher, they can see notes from their teacher or admins (who have no teacher_id)
                      // Actually, if it's assigned to their class, they should see it regardless of who uploaded it.
                      // The original logic tried to restrict it, but admin uploads failed.
                      // We will allow it if it's for their class.
                  });
            });
    }
}
