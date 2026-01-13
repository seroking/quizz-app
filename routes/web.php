<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\QuizController;

Route::middleware(['auth'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/{topic}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{topic}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/history', [QuizController::class, 'history'])->name('quiz.history');
});