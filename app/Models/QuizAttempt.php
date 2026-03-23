<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'student_id',
        'quiz_id',
        'score',
        'total_marks',
        'time_taken_seconds',
        'started_at',
        'completed_at',
        'status',
        'is_blocked',
        'block_reason',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
