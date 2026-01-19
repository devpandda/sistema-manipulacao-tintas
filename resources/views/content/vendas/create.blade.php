@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Venda')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Vendas & Comercial /</span> Nova Venda
</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Registrar Venda / PDV</h5>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('vendas.store') }}" method="POST">
                    @csrf
                    @include('content.vendas._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
