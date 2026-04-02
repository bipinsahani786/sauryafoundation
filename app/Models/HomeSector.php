<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSector extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'content',
        'image_path',
        'link',
        'tag',
        'order',
        'is_active',
    ];
 
    protected $casts = [
        'is_active' => 'boolean',
        'stats' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($sector) {
            if (empty($sector->slug)) {
                $sector->slug = \Illuminate\Support\Str::slug($sector->title);
            }
        });
    }
}
