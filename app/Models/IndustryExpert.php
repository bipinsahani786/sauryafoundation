<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryExpert extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'bio',
        'image',
        'linkedin_url',
        'is_active',
        'order'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }
}
