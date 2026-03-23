<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'thumbnail',
        'status',
        'price',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class)->orderBy('order');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->using(CourseUser::class)
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }
}
