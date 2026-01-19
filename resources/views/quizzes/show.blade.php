<!DOCTYPE html>
<html>
<head>
    <title>{{ $quiz->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .question { margin-bottom: 25px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .answers div { margin-left: 20px; }
        button { padding: 10px 20px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>{{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
        @csrf

        @foreach ($quiz->questions as $question)
            <div class="question">
                <p><strong>{{ $loop->iteration }}. {{ $question->question }}</strong></p>
                <div class="answers">
                    @foreach ($question->answers as $answer)
                        <div>
                            <label>
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                                {{ $answer->answer }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit">Submit Quiz</button>
    </form>

    <p><a href="{{ route('topics.quizzes', $quiz->topic) }}">Back to Quizzes</a></p>
    <p><a href="{{ route('topics.index') }}">Back to Topics</a></p>
</body>
</html>
