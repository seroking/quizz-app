<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        Answer::truncate();

        $questions = Question::all();

        foreach ($questions as $question) {
            match ($question->question) {

                'What is line weight?' => Answer::insert([
                    ['question_id' => $question->id, 'answer' => 'Thickness variation of lines', 'is_correct' => true],
                    ['question_id' => $question->id, 'answer' => 'Color saturation', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Canvas resolution', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Brush opacity', 'is_correct' => false],
                ]),

                'What does gesture drawing focus on?' => Answer::insert([
                    ['question_id' => $question->id, 'answer' => 'Capturing motion and action', 'is_correct' => true],
                    ['question_id' => $question->id, 'answer' => 'Detailed anatomy', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Color accuracy', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Perspective grids', 'is_correct' => false],
                ]),

                'What is shading used for?' => Answer::insert([
                    ['question_id' => $question->id, 'answer' => 'Creating light and shadow', 'is_correct' => true],
                    ['question_id' => $question->id, 'answer' => 'Choosing brushes', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Defining line weight', 'is_correct' => false],
                    ['question_id' => $question->id, 'answer' => 'Setting canvas size', 'is_correct' => false],
                ]),

                default => null,
            };
        }
    }
}
