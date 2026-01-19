@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Cliente')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Clientes
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Editar Cliente: {{ $cliente->nome }}</h5>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card-body">
        <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('PUT')
            @include('content.clientes._form')
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
