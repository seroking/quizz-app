@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Quiz Topics</h1>
    <div class="row">
        @foreach($topics as $topic)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $topic->title }}</h5>
                    <p class="card-text">{{ $topic->description }}</p>
                    <p><strong>Questions:</strong> {{ $topic->questions_count }}</p>
                    <a href="{{ route('quiz.show', $topic->id) }}" class="btn btn-primary">Start Quiz</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection