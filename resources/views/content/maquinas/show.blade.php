@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhes da Máquina')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Máquinas / Detalhes
</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Máquina: {{ $maquina->nome }}</h5>
                <div>
                    <a href="{{ route('maquinas.edit', $maquina->id_maquina) }}" class="btn btn-primary me-2">Editar</a>
                    <a href="{{ route('maquinas.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Nome:</label> <p>{{ $maquina->nome }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status:</label> 
                        <span class="badge bg-label-{{ $maquina->status == 'Disponível' ? 'success' : 'warning' }}">{{ $maquina->status }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Marca:</label> <p>{{ $maquina->marca }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Modelo:</label> <p>{{ $maquina->modelo }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Nº Série:</label> <p>{{ $maquina->numero_serie }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Capacidade:</label> <p>{{ $maquina->capacidade }}</p>
                    </div>
                     <div class="col-md-4 mb-3">
                        <label class="fw-bold">Ativo:</label> 
                        <span class="badge bg-label-{{ $maquina->ativo ? 'success' : 'danger' }}">{{ $maquina->ativo ? 'Sim' : 'Não' }}</span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Observações:</label> <p>{{ $maquina->observacoes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
