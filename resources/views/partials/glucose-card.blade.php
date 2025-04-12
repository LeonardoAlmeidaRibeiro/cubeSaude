<div class="card">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between">
            <span>Glicose</span>
            <a href="{{ route('glucose.create') }}" class="text-white">+ Nova</a>
        </div>
    </div>
    <div class="card-body">
        @if($todayGlucose->isEmpty())
            <p class="text-muted">Nenhuma medição hoje</p>
        @else
            <ul class="list-group">
                @foreach($todayGlucose as $measurement)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        {{ $measurement->value }} mg/dL
                        <small class="text-muted">({{ $measurement->measurement_type }})</small>
                    </span>
                    <span>{{ $measurement->measured_at->format('H:i') }}</span>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>