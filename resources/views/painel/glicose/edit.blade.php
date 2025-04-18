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
                            <h5 class="mb-0">Editar Medição de Glicose</h5>
                            <a href="{{ route('glucose.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('glucose.update', $glucose->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Campo Valor da Glicose -->
                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor da Glicose (mg/dL)*</label>
                                <input type="number" step="0.1" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor', $glucose->valor) }}" required>
                                @error('valor')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo Tipo da Medição -->
                            <div class="mb-3">
                                <label for="tipo_medicao" class="form-label">Tipo da Medição*</label>
                                <select class="form-control @error('tipo_medicao') is-invalid @enderror" id="tipo_medicao" name="tipo_medicao" required>
                                    <option value="">Selecione</option>
                                    <option value="jejum" {{ old('tipo_medicao', $glucose->tipo_medicao) == 'jejum' ? 'selected' : '' }}>Jejum</option>
                                    <option value="pre-refeicao" {{ old('tipo_medicao', $glucose->tipo_medicao) == 'pre-refeicao' ? 'selected' : '' }}>Pré-refeição</option>
                                    <option value="pos-refeicao" {{ old('tipo_medicao', $glucose->tipo_medicao) == 'pos-refeicao' ? 'selected' : '' }}>Pós-refeição</option>
                                </select>
                                @error('tipo_medicao')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo Data e Hora da Medição -->
                            <div class="mb-3">
                                <label for="medido_em" class="form-label">Data e Hora da Medição*</label>
                                <input type="datetime-local" class="form-control @error('medido_em') is-invalid @enderror" id="medido_em" name="medido_em" value="{{ old('medido_em', \Carbon\Carbon::parse($glucose->medido_em)->format('Y-m-d\TH:i')) }}" required>
                                @error('medido_em')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('glucose.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>&nbsp;
                                <button type="submit" class="btn btn-primary text-white">
                                    <i class="fas fa-save"></i> Atualizar Medição
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
