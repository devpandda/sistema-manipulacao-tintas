@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhes da Venda')

@section('page-style')
  <style>
    @media print {

      .layout-menu,
      .layout-navbar,
      .content-footer,
      .btn,
      .card-footer {
        display: none !important;
      }

      .layout-page {
        padding: 0 !important;
      }

      .content-wrapper {
        padding: 0 !important;
      }

      .card {
        box-shadow: none !important;
        border: none !important;
      }
    }
  </style>
@endsection

@section('content')
  <h4 class="py-3 mb-4 d-print-none">
    <span class="text-muted fw-light">Vendas & Comercial /</span> Detalhes da Venda #{{ $venda->id_venda }}
  </h4>

  <div class="row">
    <!-- Invoice Header -->
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h4 class="mb-1">Venda #{{ $venda->id_venda }}</h4>
              @if ($venda->descricao)
                <h6 class="text-primary">{{ $venda->descricao }}</h6>
              @endif
              <p class="mb-0 text-muted">Data: {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y H:i') }}</p>
            </div>
            <div>
              <span
                class="badge bg-label-{{ $venda->status == 'Finalizada' ? 'success' : 'warning' }} fs-5">{{ $venda->status }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <h6 class="fw-bold">Cliente:</h6>
              <p>{{ $venda->cliente->nome ?? 'Cliente Removido' }}</p>
              <p>{{ $venda->cliente->email ?? '' }}</p>
            </div>
            <div class="col-sm-6 text-end">
              <h6 class="fw-bold">Resumo:</h6>
              <p>Total: <strong>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</strong></p>
            </div>
          </div>
          @if ($venda->observacoes)
            <div class="row mt-3">
              <div class="col-12">
                <h6 class="fw-bold">Observações:</h6>
                <p class="mb-0 bg-lighter p-2 rounded">{{ $venda->observacoes }}</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Items List -->
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header">Itens da Venda</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>Imagem</th>
                <th>Produto</th>
                <th>Qtd.</th>
                <th>Valor Unit.</th>
                <th>Total</th>
                <th>Manipulação</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($venda->itens as $item)
                <tr>
                  <td>
                    @if ($item->produto->imagem)
                      <img src="{{ asset('storage/' . $item->produto->imagem) }}" alt="Img" class="rounded-circle"
                        width="40" height="40">
                    @else
                      <div class="avatar avatar-sm">
                        <span class="avatar-initial rounded-circle bg-label-secondary"><i
                            class="ri-image-2-line"></i></span>
                      </div>
                    @endif
                  </td>
                  <td>{{ $item->produto->nome ?? 'Produto Removido' }}</td>
                  <td>{{ $item->quantidade }}</td>
                  <td>R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
                  <td>R$ {{ number_format($item->valor_total, 2, ',', '.') }}</td>
                  <td>
                    @if ($item->manipulacao)
                      <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseMan{{ $item->id_item_venda }}" aria-expanded="false">
                        Ver Detalhes (Manipulado)
                      </button>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                </tr>
                @if ($item->manipulacao)
                  <tr>
                    <td colspan="6" class="p-0">
                      <div class="collapse" id="collapseMan{{ $item->id_item_venda }}">
                        <div class="p-3 bg-lighter">
                          <h6 class="mb-2">Detalhes da Manipulação</h6>
                          <div class="row">
                            <div class="col-md-4">
                              <strong>Máquina:</strong> {{ $item->manipulacao->maquina->nome ?? 'N/A' }}<br>
                              <strong>Fórmula:</strong> {{ $item->manipulacao->id_formula }}<br>
                              <strong>Data:</strong>
                              {{ \Carbon\Carbon::parse($item->manipulacao->data_execucao)->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-md-8">
                              <strong>Ingredientes Utilizados (Rastreabilidade):</strong>
                              <ul>
                                @forelse($item->manipulacao->itens as $ingrediente)
                                  <li>
                                    {{ $ingrediente->produto->nome ?? 'Ingrediente' }} -
                                    Qtd: {{ $ingrediente->quantidade_usada }}
                                    (Lote: {{ $ingrediente->estoque->lote ?? 'N/A' }})
                                  </li>
                                @empty
                                  <li>Nenhum ingrediente registrado.</li>
                                @endforelse
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer text-end">
          <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Voltar</a>
          <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
        </div>
      </div>
    </div>
  </div>
@endsection
