<!DOCTYPE html>
<html>
<head>
    <title>{{ $quiz->title }} - Result</title>
</head>
<body>
    <h1>{{ $quiz->title }} - Result</h1>

    <p>You scored {{ $score }} out of {{ $total }}</p>

    <p><a href="{{ route('topics.quizzes', $quiz->topic) }}">Back to Quizzes</a></p>
    <p><a href="{{ route('topics.index') }}">Back to Topics</a></p>
</body>
</html>
