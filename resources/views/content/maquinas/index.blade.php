@extends('layouts/contentNavbarLayout')

@section('title', 'Máquinas')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Máquinas
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista de Máquinas</h5>
        <a href="{{ route('maquinas.create') }}" class="btn btn-primary">Nova Máquina</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Nº Série</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($maquinas as $maquina)
                <tr>
                    <td><strong>{{ $maquina->nome }}</strong></td>
                    <td>{{ $maquina->modelo }}</td>
                    <td>{{ $maquina->marca }}</td>
                    <td>{{ $maquina->numero_serie }}</td>
                    <td>
                        @php
                            $statusClass = match($maquina->status) {
                                'Disponível' => 'success',
                                'Em Manutenção' => 'warning',
                                'Em Uso' => 'info',
                                'Inativo' => 'secondary',
                                default => 'primary'
                            };
                        @endphp
                        <span class="badge bg-label-{{ $statusClass }} me-1">{{ $maquina->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('maquinas.show', $maquina->id_maquina) }}" class="btn btn-sm btn-info" title="Visualizar"><i class="ri-eye-line me-1"></i> Ver</a>
                        <a href="{{ route('maquinas.edit', $maquina->id_maquina) }}" class="btn btn-sm btn-primary" title="Editar"><i class="ri-pencil-line me-1"></i> Editar</a>
                        <form action="{{ route('maquinas.destroy', $maquina->id_maquina) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta máquina?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir"><i class="ri-delete-bin-6-line me-1"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma máquina cadastrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
