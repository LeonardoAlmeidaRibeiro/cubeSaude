@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Meus Exercícios</h1>
            <a href="{{ route('exercises.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Exercício
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($exercicios->isEmpty())
                <p class="text-muted">Nenhum exercício registrado ainda.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Atividade</th>
                                <th>Duração (minutos)</th>
                                <th>Realizado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exercicios as $exercise)
                            <tr>
                                <td>{{ $exercise->atividade }}</td>
                                <td>{{ $exercise->duracao }}</td>
                                <td>{{ $exercise->realizado_em->format('d/m/Y H:i') ?? "--" }}</td>
                                <td>
                                    <a href="{{ route('exercises.edit', $exercise) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('exercises.destroy', $exercise) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja remover este exercício?')">
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
