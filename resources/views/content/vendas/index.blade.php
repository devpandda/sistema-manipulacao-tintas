@extends('layouts/contentNavbarLayout')

@section('title', 'Vendas')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Vendas & Comercial /</span> Lista de Vendas
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Histórico de Vendas</h5>
        <a href="{{ route('vendas.create') }}" class="btn btn-primary">Nova Venda</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($vendas as $venda)
                <tr>
                    <td><strong>{{ $venda->id_venda }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y H:i') }}</td>
                    <td>{{ $venda->cliente->nome ?? 'Cliente Removido' }}</td>
                    <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                    <td><span class="badge bg-label-success">{{ $venda->status }}</span></td>
                    <td>
                        <a href="{{ route('vendas.show', $venda->id_venda) }}" class="btn btn-sm btn-info"><i class="ri-eye-line me-1"></i> Ver</a>
                        <form action="{{ route('vendas.destroy', $venda->id_venda) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancelar esta venda?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma venda registrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
