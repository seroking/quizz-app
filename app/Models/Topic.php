<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'description'];
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function scoreHistories()
    {
        return $this->hasMany(ScoreHistory::class);
    }
}
