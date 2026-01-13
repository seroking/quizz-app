<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Question;
use App\Models\ScoreHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class QuizController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('questions')->get();
        return view('quiz.index', compact('topics'));
    }
    
    public function show($topicId)
    {
        $topic = Topic::with(['questions' => function($query) {
            $query->with('answers');
        }])->findOrFail($topicId);
        
        return view('quiz.quiz', compact('topic'));
    }
    
    public function submit(Request $request, $topicId)
    {
        $questions = Question::where('topic_id', $topicId)->with('correctAnswers')->get();
        $score = 0;
        $userAnswers = $request->input('answers', []);
        
        foreach ($questions as $question) {
            $userAnswer = $userAnswers[$question->id] ?? null;
            
            if ($question->type === 'multiple_choice') {
                $correctAnswerIds = $question->correctAnswers->pluck('id')->toArray();
                if (is_array($userAnswer) && !array_diff($correctAnswerIds, $userAnswer) && !array_diff($userAnswer, $correctAnswerIds)) {
                    $score++;
                }
            } elseif ($question->type === 'true_false') {
                $correctAnswer = $question->correctAnswers->first();
                if ($correctAnswer && $userAnswer == $correctAnswer->id) {
                    $score++;
                }
            }
        }
        
        $percentage = ($score / $questions->count()) * 100;
        
        ScoreHistory::create([
            'user_id' => Auth::id(),
            'topic_id' => $topicId,
            'score' => $score,
            'total_questions' => $questions->count(),
            'percentage' => $percentage,
            'time_taken' => $request->input('time_taken', 0)
        ]);
        
        return response()->json([
            'score' => $score,
            'total' => $questions->count(),
            'percentage' => round($percentage, 2)
        ]);
    }
    
    public function history()
    {
        $histories = ScoreHistory::where('user_id', Auth::id())
            ->with('topic')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('quiz.history', compact('histories'));
    }

}
