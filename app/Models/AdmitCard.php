<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    protected $fillable = [
        'user_id',
        'student_class',
        'exam_name',
        'roll_no',
        'exam_center',
        'exam_date',
        'instructions',
    ];

    protected $casts = [
        'exam_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
