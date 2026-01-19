@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Máquina')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Máquinas
</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Nova Máquina</h5>
            <div class="card-body">
                <form action="{{ route('maquinas.store') }}" method="POST">
                    @csrf
                    @include('content.maquinas._form')
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Salvar</button>
                        <a href="{{ route('maquinas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
