<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'quiz_enrollment_id',
        'course_id',
        'total_amount',
        'commission_percent',
        'amount',
        'type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function quizEnrollment()
    {
        return $this->belongsTo(QuizEnrollment::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
