@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<div class="row">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Adicionar Pressão Arterial</h5>
                            <a href="{{ route('registros-pressao.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('registros-pressao.store') }}" method="POST">
                            @csrf

                            <!-- Data da medição -->
                            <div class="mb-3">
                                <label for="data" class="form-label">Data da Medição*</label>
                                <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data') }}" required>
                                @error('data')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pressão Sistólica -->
                            <div class="mb-3">
                                <label for="sistolica" class="form-label">Pressão Sistólica (mmHg)*</label>
                                <input type="number" class="form-control @error('sistolica') is-invalid @enderror" id="sistolica" name="sistolica" value="{{ old('sistolica') }}" required>
                                @error('sistolica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pressão Diastólica -->
                            <div class="mb-3">
                                <label for="diastolica" class="form-label">Pressão Diastólica (mmHg)*</label>
                                <input type="number" class="form-control @error('diastolica') is-invalid @enderror" id="diastolica" name="diastolica" value="{{ old('diastolica') }}" required>
                                @error('diastolica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pulso -->
                            <div class="mb-3">
                                <label for="pulso" class="form-label">Pulso (bpm)</label>
                                <input type="number" class="form-control @error('pulso') is-invalid @enderror" id="pulso" name="pulso" value="{{ old('pulso') }}">
                                @error('pulso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Observações -->
                            <div class="mb-3">
                                <label for="observacoes" class="form-label">Observações</label>
                                <textarea class="form-control @error('observacoes') is-invalid @enderror" id="observacoes" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
                                @error('observacoes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botões -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-eraser"></i> Limpar
                                </button>&nbsp;
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Salvar Registro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
