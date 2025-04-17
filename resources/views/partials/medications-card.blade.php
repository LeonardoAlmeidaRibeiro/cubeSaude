<div class="card">
    <div class="card-header bg-success text-white">
        <div class="d-flex justify-content-between">
            <span>Medicamentos</span>
            <a href="{{ route('medicamentos.create') }}" class="text-white">+ Novo</a>
        </div>
    </div>
    <div class="card-body">
        @if($todayMedications->isEmpty())
            <p class="text-muted">Nenhum medicamento hoje</p>
        @else
            <ul class="list-group">
                @foreach($todayMedications as $medication)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        {{ $medication->name }} 
                        <small class="text-muted">({{ $medication->dosage }})</small>
                    </span>
                    <span class="badge {{ $medication->taken ? 'bg-success' : 'bg-warning' }}">
                        {{ $medication->time }} {{ $medication->taken ? '✔' : '' }}
                    </span>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>