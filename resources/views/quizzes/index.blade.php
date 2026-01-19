<!DOCTYPE html>
<html>
<head>
    <title>Quizzes for {{ $topic->name }}</title>
</head>
<body>
    <h1>Quizzes for "{{ $topic->name }}"</h1>
    <ul>
        @foreach ($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a>
            </li>
        @endforeach
    </ul>

    <p><a href="{{ route('topics.index') }}">Back to Topics</a></p>
</body>
</html>
