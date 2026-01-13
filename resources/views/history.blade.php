@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Your Quiz History</h1>
    
    @if($histories->isEmpty())
        <div class="alert alert-info">You haven't taken any quizzes yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Score</th>
                        <th>Percentage</th>
                        <th>Time Taken</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->topic->title }}</td>
                        <td>{{ $history->created_at->format('M d, Y H:i') }}</td>
                        <td>{{ $history->score }}/{{ $history->total_questions }}</td>
                        <td>
                            <span class="badge bg-{{ $history->percentage >= 70 ? 'success' : ($history->percentage >= 50 ? 'warning' : 'danger') }}">
                                {{ number_format($history->percentage, 1) }}%
                            </span>
                        </td>
                        <td>
                            @if($history->time_taken)
                                {{ floor($history->time_taken / 60) }}:{{ str_pad($history->time_taken % 60, 2, '0', STR_PAD_LEFT) }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            <canvas id="historyChart"></canvas>
        </div>
    @endif
    
    <a href="{{ route('quiz.index') }}" class="btn btn-primary">Back to Quizzes</a>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const histories = @json($histories);
    
    if (histories.length > 0) {
        const ctx = document.getElementById('historyChart').getContext('2d');
        const labels = histories.map(h => h.topic.title + '\n' + h.created_at);
        const scores = histories.map(h => h.percentage);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quiz Performance (%)',
                    data: scores,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    }
});
</script>
@endpush