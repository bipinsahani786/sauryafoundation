<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Content;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'title',
        'order',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('order');
    }
}
