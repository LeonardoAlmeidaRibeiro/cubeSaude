@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<br>

<!-- Content Row -->
<div class="row">
    <!-- Notificações -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-warning">
            <div class="card-header bg-danger text-dark d-flex justify-content-between">
                <span>Alertas e Lembretes</span>
                <span class="badge bg-danger">{{ count($notifications) }}</span>
            </div>
            <div class="card-body">
                @if(count($notifications) > 0)
                <div class="list-group">
                    @foreach($notifications as $notification)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 {{ $notification['urgent'] ? 'text-danger' : '' }}">
                                    {{ $notification['title'] }}
                                </h6>
                                <small class="text-muted">{{ $notification['message'] }}</small>
                            </div>
                            <small>{{ $notification['time'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Nenhum alerta no momento</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Card de Glicose -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <span>Medições de Glicose</span>
                <a href="{{ route('glucose.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-clipboard-pulse"></i> Acessar
                </a>
            </div>
            <div class="card-body">
                @if($medicoesHoje && $medicoesHoje->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Horário</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicoesHoje as $medicao)
                            <tr>
                                <td class="{{ $medicao->valor > 180 ? 'text-danger' : ($medicao->valor < 70 ? 'text-warning' : 'text-success') }}">
                                    <strong>{{ $medicao->valor }}</strong> mg/dL
                                </td>
                                <td>{{ $medicao->tipo_medicao ? ucfirst(str_replace('-', ' ', $medicao->tipo_medicao)) : 'N/A' }}</td>
                                <td>{{ $medicao->medido_em ? $medicao->medido_em->format('H:i') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted mb-0">Nenhuma medição registrada hoje</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Card de Medicamentos Glicose-->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <span>Medicamentos Diabetes</span>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-capsule"></i> Acessar
                </a>
            </div>
            <div class="card-body">
                @if(isset($proximoMedicamento) && $proximoMedicamento->count())
                <div class="list-group">
                    @foreach($proximoMedicamento as $medicamento)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $medicamento->nome }}</strong>
                                <div class="text-muted small">{{ $medicamento->dosagem }}</div>
                            </div>
                            <span class="badge {{ $medicamento->tomado ? 'bg-success' : 'bg-warning' }}">
                                {{ $medicamento->horario->format('H:i') }} {{ $medicamento->tomado ? '✅' : '❎' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Nenhum medicamento para hoje</p>
                @endif
            </div>
        </div>
    </div>



    <!-- Card de Pressão -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <span>Medições de Pressão</span>
                <a href="{{ route('registros-pressao.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-egg-fried"></i> Acessar
                </a>
            </div>
            <div class="card-body">
                @if(isset($pressaoHoje) && $pressaoHoje->count())
                <div class="list-group">
                    @foreach($pressaoHoje as $pressao)
                    <div class="list-group-item list-group-item-light mb-2 rounded shadow-sm">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">
                                <span class="text-primary">{{ $pressao->pressao_sistolica }}/{{ $pressao->pressao_diastolica }}</span>
                            </h5>
                            <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::parse($pressao->data)->format('d/m/Y') }}
                        </div>
                        <div class="mt-2 d-flex justify-content-between">
                            <span class="badge bg-info text-dark">
                                Pulso: {{ $pressao->pulso ?? '—' }}
                            </span>
                            <span class="badge 
                                    {{ 
                                        $pressao->categoria === 'Normal' ? 'bg-success' : 
                                        ($pressao->categoria === 'Alta' ? 'bg-danger' : 'bg-warning text-dark') 
                                    }}">
                                {{ $pressao->categoria }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Nenhum registro de pressão hoje</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Card de Medicamentos Pressão-->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between">
                <span>Medicamentos Pressão</span>
                <a href="{{ route('medicamento-pressao.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-capsule"></i> Acessar
                </a>
            </div>
            <div class="card-body">
                @if(isset($medicamentoPressaoHoje) && $medicamentoPressaoHoje->count())
                <div class="list-group">
                    @foreach($medicamentoPressaoHoje as $medicamento)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $medicamento->nome }}</strong>
                                <div class="text-muted small">{{ $medicamento->dosagem }}</div>
                            </div>
                            <span class="badge {{ $medicamento->tomado ? 'bg-success' : 'bg-warning' }}">
                                {{ $medicamento->horario->format('H:i') }} {{ $medicamento->tomado ? '✅' : '❎' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted mb-0">Nenhum medicamento para hoje</p>
                @endif
            </div>
        </div>
    </div>

        <!-- Card de Refeições -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between">
                    <span>Refeições</span>
                    <a href="{{ route('refeicoes.index') }}" class="btn btn-outline-light">
                        <i class="bi bi-egg-fried"></i> Acessar
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($refeicoesHoje) && $refeicoesHoje->count())
                    <div class="row">
                        @foreach($refeicoesHoje as $refeicao)
                        <div class="col-12 mb-3">
                            <div class="border p-3 rounded bg-light">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ ucfirst($refeicao->nome) }}</strong>
                                    <span class="badge bg-light text-dark"> {{ \Carbon\Carbon::parse($refeicao->consumido_em)->format('d/m/Y H:i') }} </span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="badge bg-white text-dark">{{ ucfirst($refeicao->tipo_refeicao) }}</span>
                                    <span class="badge bg-warning text-dark">{{ $refeicao->carboidratos }}g Carbs</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted mb-0">Nenhuma refeição registrada hoje</p>
                    @endif
                </div>
            </div>
        </div>
    
        <!-- Card de Exercícios - col-md-6 para metade da largura -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-warning text-white d-flex justify-content-between">
                    <span>Atividades Físicas</span>
                    <a href="{{ route('exercises.index') }}" class="btn btn-outline-light">Acessar</a>
                </div>
                <div class="card-body">
                    @if(isset($todayExercises) && $todayExercises->count())
                    <div class="list-group">
                        @foreach($todayExercises as $exercise)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ ucfirst($exercise->atividade) }}</strong>
                                    <div class="text-muted small">{{ $exercise->duracao }} minutos</div>
                                </div>
                                <span class="badge bg-light text-dark">{{\Carbon\Carbon::parse($exercise->realizado_em)->format('d/m/Y H:i')}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted mb-0">Nenhuma atividade registrada hoje</p>
                    @endif
                </div>
            </div>
        </div>

</div>


@endsection
