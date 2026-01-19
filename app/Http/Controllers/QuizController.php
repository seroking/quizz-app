<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Quiz;

class QuizController extends Controller
{
    // /topics/{topic}/quizzes
    public function byTopic(Topic $topic)
    {
        $quizzes = $topic->quizzes;

        return view('quizzes.index', compact('topic', 'quizzes'));
    }

    // /quizzes/{quiz}
    public function show(Quiz $quiz)
    {
        $quiz->load(['questions.answers']);

        return view('quizzes.show', compact('quiz'));
    }
}
