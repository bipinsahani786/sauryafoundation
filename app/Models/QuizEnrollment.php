<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizEnrollment extends Model
{
    protected $fillable = [
        'student_id',
        'quiz_id',
        'paid_amount',
        'status',
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
