@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<!-- Content Row -->
<div class="row">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Editar Refeição</h5>
                            <a href="{{ route('refeicoes.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('refeicoes.update', ['refeicao' => $refeicao->id]) }}" method="POST">                            @csrf
                            @method('PUT')

                            <!-- Nome da Refeição -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome da Refeição*</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $refeicao->nome) }}" required>
                                @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tipo da Refeição -->
                            <div class="mb-3">
                                <label for="tipo_refeicao" class="form-label">Tipo da Refeição*</label>
                                <select class="form-control @error('tipo_refeicao') is-invalid @enderror" id="tipo_refeicao" name="tipo_refeicao" required>
                                    <option value="">Selecione...</option>
                                    <option value="cafe" {{ old('tipo_refeicao', $refeicao->tipo_refeicao) == 'cafe' ? 'selected' : '' }}>Café da manhã</option>
                                    <option value="almoco" {{ old('tipo_refeicao', $refeicao->tipo_refeicao) == 'almoco' ? 'selected' : '' }}>Almoço</option>
                                    <option value="jantar" {{ old('tipo_refeicao', $refeicao->tipo_refeicao) == 'jantar' ? 'selected' : '' }}>Jantar</option>
                                    <option value="lanche" {{ old('tipo_refeicao', $refeicao->tipo_refeicao) == 'lanche' ? 'selected' : '' }}>Lanche</option>
                                </select>
                                @error('tipo_refeicao')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Carboidratos -->
                            <div class="mb-3">
                                <label for="carboidratos" class="form-label">Carboidratos (g)*</label>
                                <input type="number" step="0.1" class="form-control @error('carboidratos') is-invalid @enderror" id="carboidratos" name="carboidratos" value="{{ old('carboidratos', $refeicao->carboidratos) }}" required>
                                @error('carboidratos')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Data e Hora do Consumo -->
                            <div class="mb-3">
                                <label for="consumido_em" class="form-label">Data e Hora da Refeição*</label>
                                <input type="datetime-local" class="form-control @error('consumido_em') is-invalid @enderror" id="consumido_em" name="consumido_em" value="{{ old('consumido_em', \Carbon\Carbon::parse($refeicao->consumido_em)->format('Y-m-d\TH:i')) }}">
                                @error('consumido_em')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('refeicoes.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>&nbsp;
                                <button type="submit" class="btn btn-primary text-white">
                                    <i class="fas fa-save"></i> Atualizar Refeição
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
