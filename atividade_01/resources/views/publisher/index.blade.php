@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Editoras</h1>

    {{-- Botão de adicionar — somente admin e bibliotecário --}}
    @can('manage-library')
        <a href="{{ route('publisher.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> Adicionar Editora
        </a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publishers as $publisher)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $publisher->name }}</td>
                    <td>{{ $publisher->address }}</td>
                    <td>
                        {{-- Visualizar — qualquer usuário pode --}}
                        <a href="{{ route('publisher.show', $publisher) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>

                        {{-- Editar e Excluir — somente admin e bibliotecário --}}
                        @can('manage-library')
                            <a href="{{ route('publisher.edit', $publisher) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>

                            <form action="{{ route('publisher.destroy', $publisher) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta editora?')">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Nenhuma editora encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
