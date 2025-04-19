@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Adicionar Novo Exercício</h1>
            <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('exercises.store') }}" method="POST">
                    @csrf
                
                    <div class="mb-3">
                        <label for="atividade" class="form-label">Atividade Física</label>
                        <input type="text" class="form-control @error('atividade') is-invalid @enderror" 
                               id="atividade" name="atividade" value="{{ old('atividade') }}" required>
                        @error('atividade')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duracao" class="form-label">Duração (minutos)</label>
                                <input type="number" class="form-control @error('duracao') is-invalid @enderror" 
                                       id="duracao" name="duracao" value="{{ old('duracao') }}" min="1" required>
                                @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <div class="col-md-6 mb-3">
                                <label for="realizado_em" class="form-label">Data e Hora do Exercício</label>
                                <input type="datetime-local" class="form-control @error('realizado_em') is-invalid @enderror" 
                                       id="realizado_em" name="realizado_em" value="{{ old('realizado_em') }}" required>
                                @error('realizado_em')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-eraser"></i> Limpar
                        </button>&nbsp;
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Exercício
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
