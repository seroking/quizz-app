<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'description',
    ];

    /**
     * A quiz belongs to one topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * A quiz contains multiple questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * A quiz can have many submissions (results).
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
