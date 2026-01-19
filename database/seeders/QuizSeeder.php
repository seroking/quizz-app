<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Topic;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::truncate();

        $topic = Topic::where('name', 'Drawing Fundamentals')->first();

        Quiz::create([
            'topic_id' => $topic->id,
            'title' => 'Drawing Fundamentals',
            'description' => 'Test your knowledge of drawing basics',
        ]);
    }
}
