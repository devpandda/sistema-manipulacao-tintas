@extends('layouts/contentNavbarLayout')

@section('title', 'Produtos')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Produtos
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista de Produtos</h5>
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>SKU</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Preço Venda</th>
                    <th>Estoque Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($produtos as $produto)
                <tr>
                    <td>
                        @if($produto->imagem)
                            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="Img" class="rounded-circle" width="40" height="40">
                        @else
                            <div class="avatar avatar-sm">
                                <span class="avatar-initial rounded-circle bg-label-secondary"><i class="ri-image-2-line"></i></span>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $produto->nome }}</strong></td>
                    <td>{{ $produto->sku }}</td>
                    <td>{{ $produto->marca }}</td>
                    <td>{{ $produto->categoria }}</td>
                    <td>R$ {{ number_format($produto->valor_venda, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-label-primary">{{ $produto->estoque_sum_quantidadeatual ?? 0 }} {{ $produto->unidade_padrao }}</span>
                    </td>
                    <td>
                        <span class="badge bg-label-{{ $produto->ativo ? 'success' : 'danger' }} me-1">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span>
                    </td>
                    <td>
                        <a href="{{ route('produtos.show', $produto->id_produto) }}" class="btn btn-sm btn-info" title="Visualizar/Estoque"><i class="ri-eye-line me-1"></i> Ver/Estoque</a>
                        <a href="{{ route('produtos.edit', $produto->id_produto) }}" class="btn btn-sm btn-primary" title="Editar"><i class="ri-pencil-line me-1"></i> Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id_produto) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir"><i class="ri-delete-bin-6-line me-1"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum produto cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
