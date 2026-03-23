<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    protected $casts = [
        'enrolled_at' => 'datetime',
    ];
}
