<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'image',
        'icon',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'status',
        'is_active',
        'order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date->format('d M, Y');
    }

    public function getFormattedTimeAttribute(): ?string
    {
        if (!$this->start_time) return null;
        $start = \Carbon\Carbon::createFromFormat('H:i:s', $this->start_time)->format('g:i A');
        if ($this->end_time) {
            $end = \Carbon\Carbon::createFromFormat('H:i:s', $this->end_time)->format('g:i A');
            return "{$start} – {$end}";
        }
        return $start;
    }
}
