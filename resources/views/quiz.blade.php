{{-- resources/views/quiz/quiz.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $topic->title }} Quiz</h4>
                    <div id="timer" class="text-danger"></div>
                </div>
                
                <form id="quizForm">
                    @csrf
                    <input type="hidden" name="time_taken" id="time_taken">
                    
                    <div class="card-body">
                        @foreach($topic->questions as $index => $question)
                        <div class="question mb-4" data-question-id="{{ $question->id }}">
                            <h5>Question {{ $index + 1 }}: {{ $question->question_text }}</h5>
                            
                            @if($question->type === 'multiple_choice')
                                @foreach($question->answers as $answer)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" 
                                           name="answers[{{ $question->id }}][]" 
                                           value="{{ $answer->id }}" 
                                           id="answer_{{ $answer->id }}">
                                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                                @endforeach
                            @elseif($question->type === 'true_false')
                                @foreach($question->answers as $answer)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           value="{{ $answer->id }}" 
                                           id="answer_{{ $answer->id }}">
                                    <label class="form-check-label" for="answer_{{ $answer->id }}">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    
                    <div class="card-footer">
                        <button type="button" id="submitQuiz" class="btn btn-success btn-lg">Submit Quiz</button>
                        <div id="result" class="mt-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Timer functionality
    let startTime = new Date().getTime();
    let timerElement = document.getElementById('timer');
    let timeTakenInput = document.getElementById('time_taken');
    
    function updateTimer() {
        let currentTime = new Date().getTime();
        let timeElapsed = Math.floor((currentTime - startTime) / 1000);
        let minutes = Math.floor(timeElapsed / 60);
        let seconds = timeElapsed % 60;
        
        timerElement.textContent = `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Update hidden input for time tracking
        timeTakenInput.value = timeElapsed;
    }
    
    // Update timer every second
    setInterval(updateTimer, 1000);
    updateTimer(); // Initial call
    
    // Quiz submission with AJAX
    document.getElementById('submitQuiz').addEventListener('click', function() {
        const form = document.getElementById('quizForm');
        const submitBtn = this;
        const resultDiv = document.getElementById('result');
        
        // Disable submit button to prevent multiple submissions
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
        
        // Collect form data
        const formData = new FormData(form);
        
        // Send AJAX request
        fetch("{{ route('quiz.submit', $topic->id) }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Show result
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <h4>Quiz Submitted Successfully!</h4>
                    <p>Your Score: ${data.score}/${data.total}</p>
                    <p>Percentage: ${data.percentage}%</p>
                    <a href="{{ route('quiz.index') }}" class="btn btn-primary mt-2">Back to Quizzes</a>
                    <a href="{{ route('quiz.history') }}" class="btn btn-info mt-2">View History</a>
                </div>
            `;
            
            // Scroll to result
            resultDiv.scrollIntoView({ behavior: 'smooth' });
            
            // Disable all form inputs
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.disabled = true);
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    There was an error submitting your quiz. Please try again.
                </div>
            `;
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Quiz';
        });
    });
    
    // Optional: Auto-save progress every 30 seconds
    let autoSaveInterval = setInterval(() => {
        const formData = new FormData(document.getElementById('quizForm'));
        // You can implement auto-save functionality here
        console.log('Auto-saving...');
    }, 30000);
});
</script>
@endpush