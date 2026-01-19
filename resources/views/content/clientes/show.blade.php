@extends('layouts/contentNavbarLayout')

@section('title', 'Visualizar Cliente')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Clientes / Visualizar
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detalhes do Cliente: {{ $cliente->nome }}</h5>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nome</label>
                <p>{{ $cliente->nome }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">CPF/CNPJ</label>
                <p>{{ $cliente->cpf_cnpj }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Telefone</label>
                <p>{{ $cliente->telefone }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <p>{{ $cliente->email }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">CEP</label>
                <p>{{ $cliente->cep }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Logradouro</label>
                <p>{{ $cliente->logradouro }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Número</label>
                <p>{{ $cliente->numero }}</p>
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold">Complemento</label>
                <p>{{ $cliente->complemento }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Bairro</label>
                <p>{{ $cliente->bairro }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Cidade</label>
                <p>{{ $cliente->cidade }}</p>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label fw-bold">Estado</label>
                <p>{{ $cliente->estado }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection
