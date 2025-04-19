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
            <div class="card-header bg-warning text-dark d-flex justify-content-between">
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
    <!-- Card de Glicose - col-md-6 para metade da largura -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <span>Medições de Glicose</span>
                <a href="{{ route('glucose.index') }}" class="btn btn-outline-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-pulse" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm-2 0h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2m6.979 3.856a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.895-.133L4.232 10H3.5a.5.5 0 0 0 0 1h1a.5.5 0 0 0 .416-.223l1.41-2.115 1.195 3.982a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h1.5a.5.5 0 0 0 0-1h-1.128z" />
                    </svg> Acessar</a>
            </div>
            <div class="card-body">
                @if($medicoesHoje && $medicoesHoje->count() > 0)
                <div class="table-responsive">
                    <div class="list-group">
                        <table class="table table-sm table-hover table-bordered">
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
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between">
                <span>Medicamentos</span>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
                        <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429z" />
                    </svg> Acessar
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
                                {{ $medicamento->horario }} {{ $medicamento->tomado ? '✔' : '⨯' }}
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

    <!-- Card de Refeições - col-md-6 para metade da largura -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <span>Refeições</span>
                <a href="{{ route('refeicoes.index') }}" class="btn btn-outline-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-egg-fried" viewBox="0 0 16 16">
                        <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        <path d="M13.997 5.17a5 5 0 0 0-8.101-4.09A5 5 0 0 0 1.28 9.342a5 5 0 0 0 8.336 5.109 3.5 3.5 0 0 0 5.201-4.065 3.001 3.001 0 0 0-.822-5.216zm-1-.034a1 1 0 0 0 .668.977 2.001 2.001 0 0 1 .547 3.478 1 1 0 0 0-.341 1.113 2.5 2.5 0 0 1-3.715 2.905 1 1 0 0 0-1.262.152 4 4 0 0 1-6.67-4.087 1 1 0 0 0-.2-1 4 4 0 0 1 3.693-6.61 1 1 0 0 0 .8-.2 4 4 0 0 1 6.48 3.273z" />
                    </svg> Acessar</a>
            </div>
            <div class="card-body">
                @if(isset($refeicoesHoje) && $refeicoesHoje->count())
                <div class="row">
                    @foreach($refeicoesHoje as $refeicao)
                    <div class="col-12 mb-3">
                        <div class="border p-3 rounded bg-light">
                            <div class="d-flex justify-content-between">
                                <strong>{{ ucfirst($refeicao->nome) }}</strong>
                                <span class="text-muted">{{ $refeicao->consumido_em }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="badge bg-white text-dark">{{ ucfirst($refeicao->tipo_refeicao) }}</span>
                                <span class="badge bg-warning text-dark">{{ $refeicao->carboidratos }}g carboidratos</span>
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
                <a href="{{ route('exercises.index') }}" class="btn btn-outline-light"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bicycle" viewBox="0 0 16 16">
                        <path d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5m1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139zM8 9.057 9.598 6.5H6.402zM4.937 9.5a2 2 0 0 0-.487-.877l-.548.877zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53z" />
                    </svg> Acessar</a>
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
                            <span class="badge bg-light text-dark">{{ $exercise->realizado_em }}</span>
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
