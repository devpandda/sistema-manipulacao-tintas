@extends('layouts/contentNavbarLayout')

@section('title', 'Clientes')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Cadastros /</span> Clientes
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista de Clientes</h5>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo Cliente</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Cidade/UF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($clientes as $cliente)
                <tr>
                    <td><strong>{{ $cliente->nome }}</strong></td>
                    <td>{{ $cliente->cpf_cnpj }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->cidade }}/{{ $cliente->estado }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id_cliente) }}" class="btn btn-sm btn-info" title="Visualizar"><i class="ri-eye-line me-1"></i> Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-primary" title="Editar"><i class="ri-pencil-line me-1"></i> Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir"><i class="ri-delete-bin-6-line me-1"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhum cliente cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
