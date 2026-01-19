<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        Question::truncate();

        $quiz = Quiz::where('title', 'Drawing Fundamentals')->first();

        Question::insert([
            [
                'quiz_id' => $quiz->id,
                'question' => 'What is line weight?',
            ],
            [
                'quiz_id' => $quiz->id,
                'question' => 'What does gesture drawing focus on?',
            ],
            [
                'quiz_id' => $quiz->id,
                'question' => 'What is shading used for?',
            ],
        ]);
    }
}
