@extends('layouts/contentNavbarLayout')

@section('title', 'Configurações')

@section('content')
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Configurações /</span> Geral
  </h4>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Configurações Gerais</h5>
        <div class="card-body">
          <form action="{{ route('settings.update') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="msg_etiqueta" class="form-label">Mensagem da Etiqueta</label>
              <textarea class="form-control @error('msg_etiqueta') is-invalid @enderror" id="msg_etiqueta" name="msg_etiqueta"
                rows="3" placeholder="Digite a mensagem que aparecerá nas etiquetas de produtos manipulados">{{ old('msg_etiqueta', $msgEtiqueta->valor) }}</textarea>
              <div class="form-text">Esta mensagem será impressa em todas as etiquetas de produtos manipulados.</div>
              @error('msg_etiqueta')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mt-4">
              <button type="submit" class="btn btn-primary">Salvar Configurações</button>
              <a href="{{ route('pages-home') }}" class="btn btn-secondary">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
