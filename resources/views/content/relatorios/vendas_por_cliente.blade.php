@extends('layouts/contentNavbarLayout')

@section('title', 'Relatório de Vendas por Cliente')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Relatórios /</span> Vendas por Cliente</h4>

<div class="row">
    <!-- Search Card -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('relatorios.vendas_por_cliente') }}" method="GET">
                    <div class="row d-flex align-items-end">
                        <div class="col-md-10">
                            <label for="search" class="form-label">Buscar por Cliente</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ri-search-line"></i></span>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Digite o nome do cliente..." value="{{ $search ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Results Area -->
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Resultados</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th># Venda</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Itens</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($vendas as $venda)
                        <tr>
                            <td><strong>#{{ $venda->id_venda }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y H:i') }}</td>
                            <td>{{ $venda->cliente->nome ?? 'Cliente Desconhecido' }}</td>
                            <td><span class="badge bg-label-{{ $venda->status == 'Finalizada' ? 'success' : 'warning' }}">{{ $venda->status }}</span></td>
                            <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                            <td>
                                <small class="text-muted">
                                    {{ $venda->itens->count() }} itens
                                    @foreach($venda->itens as $item)
                                        @if($item->manipulacao)
                                            <i class="ri-flask-line text-warning" title="Contém manipulação"></i>
                                        @endif
                                    @endforeach
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('vendas.show', $venda->id_venda) }}" class="btn btn-sm btn-outline-primary"><i class="ri-eye-line me-1"></i> Detalhes</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="ri-search-2-line ri-3x mb-2"></i>
                                    <p class="mb-0">Nenhuma venda encontrada. <br>Digite o nome do cliente acima para buscar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
