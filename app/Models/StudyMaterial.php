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
            ->where(function ($q) use ($user) {
                // Global Admin Notes
                $q->where(function ($sq) {
                    $sq->whereNull('teacher_id')->where('is_global', true);
                })
                // Teacher's specific notes for this student
                ->orWhere(function ($sq) use ($user) {
                    $sq->where('teacher_id', $user->teacher_id)
                        ->where(function ($ssq) use ($user) {
                            $ssq->where('is_global', true)
                                ->orWhere('class_id', $user->class_id);
                        });
                });
            });
    }
}
