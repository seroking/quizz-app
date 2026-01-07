<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreHistory extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'score', 'total_questions', 'percentage', 'time_taken'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
