@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhes do Produto')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Produtos / Detalhes
</h4>

<div class="row">
    <!-- Product Details -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Produto: {{ $produto->nome }}</h5>
                <div>
                    <a href="{{ route('produtos.edit', $produto->id_produto) }}" class="btn btn-primary me-2">Editar</a>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Nome:</label> <p>{{ $produto->nome }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
        <label class="fw-bold">SKU:</label> <p>{{ $produto->sku }}</p>
    </div>
    <div class="col-md-3 mb-3">
        <label class="fw-bold">Cód. Barras:</label> <p>{{ $produto->codigo_barra }}</p>
    </div>
    <div class="col-md-3 mb-3">
        <label class="fw-bold">Status:</label> 
        <span class="badge bg-label-{{ $produto->ativo ? 'success' : 'danger' }}">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span>
    </div>
    <div class="col-md-4 mb-3">
        <label class="fw-bold">Marca:</label> <p>{{ $produto->marca }}</p>
    </div>
    <div class="col-md-4 mb-3">
        <label class="fw-bold">Categoria:</label> <p>{{ $produto->categoria }}</p>
    </div>
    <div class="col-md-4 mb-3">
        <label class="fw-bold">Classificação:</label> <p>{{ $produto->classificacao_tinta }}</p>
    </div>
    <div class="col-md-3 mb-3">
        <label class="fw-bold">Volume:</label> <p>{{ $produto->volume }}</p>
    </div>
    <div class="col-md-3 mb-3">
        <label class="fw-bold">Unidade:</label> <p>{{ $produto->unidade_padrao }}</p>
    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Custo:</label> <p>R$ {{ number_format($produto->custo, 2, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Valor Venda:</label> <p>R$ {{ number_format($produto->valor_venda, 2, ',', '.') }}</p>
                    </div>
                     <div class="col-md-12 mb-3">
                        <label class="fw-bold">Descrição:</label> <p>{{ $produto->descricao }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Control -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Controle de Estoque (Lotes)</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddEstoque">
                    <i class="ri-add-line me-1"></i> Adicionar Lote
                </button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Lote</th>
                            <th>Qtd. Atual</th>
                            <th>Validade</th>
                            <th>Entrada</th>
                            <th>Origem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($produto->estoque as $lote)
                        <tr>
                            <td>{{ $lote->lote ?? '-' }}</td>
                            <td>
                                <strong>{{ $lote->quantidadeatual }} {{ $lote->unidade }}</strong>
                            </td>
                            <td>{{ $lote->validade ? \Carbon\Carbon::parse($lote->validade)->format('d/m/Y') : '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($lote->data_entrada)->format('d/m/Y H:i') }}</td>
                            <td>{{ $lote->origem }}</td>
                            <td>
                                <form action="{{ route('estoque.destroy', $lote->id_estoque) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este lote de estoque?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="this.closest('form').submit()"><i class="ri-delete-bin-line"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum lote de estoque registrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td><strong>Total</strong></td>
                            <td colspan="5"><strong>{{ $produto->estoque->sum('quantidadeatual') }} {{ $produto->unidade_padrao }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Stock -->
<div class="modal fade" id="modalAddEstoque" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('estoque.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_produto" value="{{ $produto->id_produto }}">
                
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Estoque</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lote" class="form-label">Lote</label>
                            <input type="text" class="form-control" id="lote" name="lote">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validade" class="form-label">Validade</label>
                            <input type="date" class="form-control" id="validade" name="validade">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="quantidadeatual" class="form-label">Quantidade <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="quantidadeatual" name="quantidadeatual" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="unidade" class="form-label">Unidade</label>
                            <input type="text" class="form-control" id="unidade" name="unidade" value="{{ $produto->unidade_padrao }}" readonly>
                        </div>
                         <div class="col-md-12 mb-3">
                            <label for="origem" class="form-label">Origem/Fornecedor</label>
                            <input type="text" class="form-control" id="origem" name="origem">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
