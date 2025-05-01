@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Medicamentos</h1>
            <a href="{{ route('medicamento-pressao.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Medicamento
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($medications->isEmpty())
                <p class="text-muted">Nenhum medicamento cadastrado ainda.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Medicamento</th>
                                <th>Dosagem</th>
                                <th>Horário</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medications as $medicamento)
                            <tr>
                                <td>{{ $medicamento->nome }}</td>
                                <td>{{ $medicamento->dosagem }}</td>
                                <td>{{ \Carbon\Carbon::parse($medicamento->horario)->format('H:i') }}</td>
                                <td>
                                    <form action="{{ route('medicamento-pressao.toggleTaken', $medicamento->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $medicamento->tomado ? 'btn-success' : 'btn-warning' }}">
                                            {{ $medicamento->tomado ? '✔ Tomado' : '⌛ Pendente' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('medicamento-pressao.edit', $medicamento->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medicamento-pressao.destroy', $medicamento) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')">
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
