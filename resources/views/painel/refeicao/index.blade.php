@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Minhas Refeições</h1>
            <a href="{{ route('refeicoes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Refeição
            </a>
        </div>
    
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="card shadow-sm">
            <div class="card-body">
                @if($refeicoes->isEmpty())
                    <p class="text-muted">Nenhuma refeição cadastrada ainda.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th>Nome da Refeição</th>
                                    <th>Tipo</th>
                                    <th>Carboidratos (g)</th>
                                    <th>Consumida em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($refeicoes as $refeicao)
                                    <tr>
                                        <td>{{ $refeicao->nome }}</td>
                                        <td>{{ ucfirst($refeicao->tipo_refeicao) }}</td>
                                        <td>{{ $refeicao->carboidratos }}</td>
                                        <td>{{ $refeicao->consumido_em ?? "--" }}</td>
                                        <td>
                                            <a href="{{ route('refeicoes.edit', $refeicao) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('refeicoes.destroy', $refeicao) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja remover esta refeição?')">
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
