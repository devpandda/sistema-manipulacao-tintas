@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Usuário')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Configurações /</span> Editar Usuário</h4>

<div class="card mb-4">
    <h5 class="card-header">Detalhes do Usuário</h5>
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
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('content.users._form')
        </form>
    </div>
</div>
@endsection
