<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'class_id');
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'class_quiz', 'student_class_id', 'quiz_id')->withTimestamps();
    }
}
