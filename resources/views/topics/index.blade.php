<!DOCTYPE html>
<html>
<head>
    <title>Topics</title>
</head>
<body>
    <h1>Topics</h1>
    <ul>
        @foreach ($topics as $topic)
            <li>
                <a href="{{ route('topics.quizzes', $topic) }}">{{ $topic->name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
