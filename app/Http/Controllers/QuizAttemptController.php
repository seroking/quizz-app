<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizAttemptController extends Controller
{
    public function submit(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.answers');

        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $selectedAnswerId = $request->input('answers.' . $question->id);

            if (!$selectedAnswerId) {
                continue;
            }

            $isCorrect = $question->answers
                ->where('id', $selectedAnswerId)
                ->where('is_correct', true)
                ->count();

            if ($isCorrect) {
                $score++;
            }
        }

        return view('quizzes.result', compact('quiz', 'score', 'total'));
    }
}
