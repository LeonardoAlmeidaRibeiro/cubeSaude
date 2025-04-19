@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Editar Exercício</h1>
            <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('exercises.update', ['exercicio' => $exercicio->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="atividade" class="form-label">Atividade Física</label>
                        <input type="text" class="form-control @error('atividade') is-invalid @enderror" id="atividade" name="atividade" value="{{ old('atividade', $exercicio->atividade) }}" → value="{{ old('atividade', $exercicio->atividade) }}"
                        required>
                        @error('atividade')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duracao" class="form-label">Duração (minutos)</label>
                                <input type="number" class="form-control @error('duracao') is-invalid @enderror" id="duracao" name="duracao" value="{{ old('duracao', $exercicio->duracao) }}" min="1" required>
                                @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="realizado_em" class="form-label">Data e Hora do Exercício</label>
                                <input type="datetime-local" class="form-control @error('realizado_em') is-invalid @enderror" id="realizado_em" name="realizado_em" value="{{ old('realizado_em', $exercicio->realizado_em) }}" required>
                                @error('realizado_em')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('exercises.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="fas fa-save"></i> Atualizar Exercício
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
