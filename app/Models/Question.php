<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['topic_id', 'question_text', 'type'];
    
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function correctAnswers()
    {
        return $this->hasMany(Answer::class)->where('is_correct', true);
    }
}
