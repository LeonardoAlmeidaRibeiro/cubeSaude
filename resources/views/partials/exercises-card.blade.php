<div class="card">
    <div class="card-header bg-warning">
        <div class="d-flex justify-content-between">
            <span>Exercícios</span>
            <a href="{{ route('exercises.create') }}" class="text-dark">+ Novo</a>
        </div>
    </div>
    <div class="card-body">
        @if($todayExercises->isEmpty())
            <p class="text-muted">Nenhum exercício hoje</p>
        @else
            <ul class="list-group">
                @foreach($todayExercises as $exercise)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ $exercise->activity }}
                        <small class="text-muted">({{ $exercise->duration }} min)</small>
                    </span>
                    <span>{{ $exercise->done_at->format('H:i') }}</span>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>