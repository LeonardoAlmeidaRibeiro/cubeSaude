@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Meus Registros de Pressão Arterial</h1>
            <a href="{{ route('registros-pressao.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Adicionar Registro
            </a>
        </div>
    
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="card shadow-sm">
            <div class="card-body">
                @if($registros->isEmpty())
                    <p class="text-muted">Nenhuma Registro de Pressão Arterial.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-primary">
                                    <th>Data</th>
                                    <th>Pressão Sistólica</th>
                                    <th>Pressão Diastólica</th>
                                    <th>Pulso</th>
                                    <th>Categoria</th>
                                    <th>Observações</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registros as $registro)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($registro->data)->format('d/m/Y') }}</td>
                                    <td>{{ $registro->pressao_sistolica }}</td>
                                    <td>{{ $registro->pressao_diastolica }}</td>
                                    <td>{{ $registro->pulso ?? '--' }}</td>
                                    <td>{{ $registro->categoria }}</td>
                                    <td>{{ $registro->observacoes ?? '--' }}</td>
                                    <td>
                                        <a href="{{ route('registros-pressao.edit', $registro) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('registros-pressao.destroy', $registro) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja remover este registro?')">
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
