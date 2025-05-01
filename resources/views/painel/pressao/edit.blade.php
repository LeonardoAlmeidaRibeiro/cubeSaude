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
                            <h5 class="mb-0">Editar Pressão Arterial</h5>
                            <a href="{{ route('registros-pressao.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('registros-pressao.update', $registro) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Data da medição -->
                            <div class="mb-3">
                                <label for="data" class="form-label">Data da Medição*</label>
                                <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data', $registro->data) }}" required>
                                @error('data')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pressão Sistólica -->
                            <div class="mb-3">
                                <label for="pressao_sistolica" class="form-label">Pressão Sistólica (mmHg)*</label>
                                <input type="number" class="form-control @error('pressao_sistolica') is-invalid @enderror" id="pressao_sistolica" name="pressao_sistolica" value="{{ old('pressao_sistolica', $registro->pressao_sistolica) }}" required>
                                @error('pressao_sistolica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pressão Diastólica -->
                            <div class="mb-3">
                                <label for="pressao_diastolica" class="form-label">Pressão Diastólica (mmHg)*</label>
                                <input type="number" class="form-control @error('pressao_diastolica') is-invalid @enderror" id="pressao_diastolica" name="pressao_diastolica" value="{{ old('pressao_diastolica', $registro->pressao_diastolica) }}" required>
                                @error('pressao_diastolica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pulso -->
                            <div class="mb-3">
                                <label for="pulso" class="form-label">Pulso (bpm)</label>
                                <input type="number" class="form-control @error('pulso') is-invalid @enderror" id="pulso" name="pulso" value="{{ old('pulso', $registro->pulso) }}">
                                @error('pulso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Observações -->
                            <div class="mb-3">
                                <label for="observacoes" class="form-label">Observações</label>
                                <textarea class="form-control @error('observacoes') is-invalid @enderror" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $registro->observacoes) }}</textarea>
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
                                    <i class="fas fa-save"></i> Atualizar Registro
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
