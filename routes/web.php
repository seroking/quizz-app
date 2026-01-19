<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizAttemptController;

/*
|--------------------------------------------------------------------------
| Public Quiz Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome'); // create resources/views/welcome.blade.php
});

// 1️⃣ List all topics
Route::get('/topics', [TopicController::class, 'index'])
    ->name('topics.index');

// 2️⃣ List quizzes for a topic
Route::get('/topics/{topic}/quizzes', [QuizController::class, 'byTopic'])
    ->name('topics.quizzes');

// 3️⃣ Show a quiz (questions + answers)
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])
    ->name('quizzes.show');

// 4️⃣ Submit quiz answers & calculate score
Route::post('/quizzes/{quiz}/submit', [QuizAttemptController::class, 'submit'])
    ->name('quizzes.submit');
;