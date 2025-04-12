<div class="card">
    <div class="card-header bg-info text-white">
        <div class="d-flex justify-content-between">
            <span>Refeições</span>
            <a href="{{ route('meals.create') }}" class="text-white">+ Nova</a>
        </div>
    </div>
    <div class="card-body">
        @if($todayMeals->isEmpty())
            <p class="text-muted">Nenhuma refeição registrada</p>
        @else
            <ul class="list-group">
                @foreach($todayMeals as $meal)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $meal->name }}</strong>
                        <span>{{ $meal->consumed_at->format('H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>{{ $meal->meal_type }}</span>
                        <span class="badge bg-secondary">{{ $meal->carbs }}g carboidratos</span>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>