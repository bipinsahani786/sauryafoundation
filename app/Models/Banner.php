<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'image_path',
        'link',
        'order',
        'is_active',
        'class_id',
        'is_global',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
