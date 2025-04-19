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
                            <h5 class="mb-0">Adicionar Novo Medicamento</h5>
                            <a href="{{ route('medicamentos.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('medicamentos.store') }}" method="POST">
                            @csrf

                            <!-- Campo Nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Medicamento*</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" required>
                                @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo Dosagem -->
                            <div class="mb-3">
                                <label for="dosagem" class="form-label">Dosagem*</label>
                                <input type="text" class="form-control @error('dosagem') is-invalid @enderror" id="dosagem" name="dosagem" value="{{ old('dosagem') }}" required>
                                @error('dosagem')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Ex: 500mg, 10 unidades, 1 comprimido</small>
                            </div>

                            <!-- Campo Horário -->
                            <div class="mb-3">
                                <label for="horario" class="form-label">Horário*</label>
                                <input type="time" class="form-control @error('horario') is-invalid @enderror" id="horario" name="horario" value="{{ old('horario') }}" required>
                                @error('horario')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-eraser"></i> Limpar
                                </button>&nbsp;
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Salvar Medicamento
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
