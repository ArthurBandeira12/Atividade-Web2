@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Usuário</h1>

    <div class="card mb-4">
        <div class="card-header">
            {{ $user->name }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Função:</strong> {{ ucfirst($user->role) }}</p>
        </div>
    </div>

    {{-- SOMENTE ADMIN PODE ALTERAR ROLE --}}
    @can('isAdmin')
    <div class="card mb-4">
        <div class="card-header">Alterar Função do Usuário</div>
        <div class="card-body">
            <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="role" class="form-label">Selecione a nova função:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="bibliotecario" {{ $user->role === 'bibliotecario' ? 'selected' : '' }}>Bibliotecário</option>
                        <option value="cliente" {{ $user->role === 'cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>
    @endcan

    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>

    <div class="card">
        <div class="card-header">Histórico de Empréstimos</div>

        <div class="card-body">
            @if($user->books->isEmpty())
                <p>Este usuário não possui empréstimos registrados.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Data de Empréstimo</th>
                        <th>Data de Devolução</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->books as $book)
                    <tr>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}">
                                {{ $book->title }}
                            </a>
                        </td>

                        <td>{{ $book->pivot->borrowed_at }}</td>

                        <td>{{ $book->pivot->returned_at ?? 'Em Aberto' }}</td>

                        <td>
                            @if(is_null($book->pivot->returned_at))
                                @can('manage-borrowings') {{-- bibliotecário e admin --}}
                                <form action="{{ route('borrowings.return', $book->pivot->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning btn-sm">Devolver</button>
                                </form>
                                @endcan
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

</div>
@endsection
