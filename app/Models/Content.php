<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Topic;
use App\Models\Quiz;
use App\Models\ContentCompletion;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'type',
        'title',
        'body',
        'quiz_id',
        'attachment_path',
        'order',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function completions()
    {
        return $this->hasMany(ContentCompletion::class);
    }

    public function isCompletedBy($userId)
    {
        return $this->completions()->where('user_id', $userId)->exists();
    }
}
