@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Medições de Glicose</h1>
            <a href="{{ route('glucose.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Medição
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($measurements->isEmpty())
                <p class="text-muted">Nenhuma medição cadastrada ainda.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Valor (mg/dL)</th>
                                <th>Tipo da Medição</th>
                                <th>Data e Hora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($measurements as $measurement)
                            <tr>
                                <td>{{ number_format($measurement->valor, 2, ',', '.') }}</td>
                                <td>{{ ucfirst(str_replace('-', ' ', $measurement->tipo_medicao)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($measurement->medido_em)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('glucose.edit', $measurement) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('glucose.destroy', $measurement) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja remover esta medição?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
