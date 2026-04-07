<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Quiz extends Model
{
    use Auditable;
    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'price',
        'status',
        'duration_minutes',
        'attempts_limit',
        'start_time',
        'end_time',
        'expires_at',
        'is_global',
        'is_contest',
        'parent_id',
        'level_number',
        'promotion_percentage',
        'winner_count',
        'is_practice_set'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'expires_at' => 'datetime',
        'is_global' => 'boolean',
        'is_contest' => 'boolean',
        'is_practice_set' => 'boolean',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function studentClasses()
    {
        return $this->belongsToMany(StudentClass::class, 'class_quiz', 'quiz_id', 'student_class_id')->withTimestamps();
    }

    public function parent()
    {
        return $this->belongsTo(Quiz::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Quiz::class, 'parent_id')->orderBy('level_number');
    }

    public function enrollments()
    {
        return $this->hasMany(QuizEnrollment::class);
    }
}
