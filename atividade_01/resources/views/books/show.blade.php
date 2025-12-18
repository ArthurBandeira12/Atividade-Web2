@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Livro</h1>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($book->cover)
    <div class="mb-3 text-center">
        <img src="{{ asset('storage/' . $book->cover) }}" alt="Capa do livro" class="img-thumbnail" style="max-height: 200px;">
        @endif
        <div class="card">
            <div class="card-header">
                <strong>Título:</strong> {{ $book->title }}
            </div>
            <div class="card-body">
                <p><strong>Autor:</strong>
                    <a href="{{ route('author.show', $book->author->id) }}">
                        {{ $book->author->name }}
                    </a>
                </p>
                <p><strong>Editora:</strong>
                    <a href="{{ route('publisher.show', $book->publisher->id) }}">
                        {{ $book->publisher->name }}
                    </a>
                </p>
                <p><strong>Categoria:</strong>
                    <a href="{{ route('categories.show', $book->category->id) }}">
                        {{ $book->category->name }}
                    </a>
                </p>
            </div>
        </div>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>

        @php
        $emprestado = $book->users()->wherePivotNull('returned_at')->exists();
        @endphp

        {{-- Se o livro está emprestado, exibir mensagem e esconder o formulário --}}
        @if($emprestado)
        <div class="alert alert-danger">
            Este livro está emprestado no momento e não pode ser emprestado novamente.
        </div>
        @endif


        <div class="card mb-4">
            <div class="card-header">Registrar Empréstimo</div>
            <div class="card-body">
                <form action="{{ route('books.borrow', $book) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="" selected>Selecione um usuário</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar Empréstimo</button>
                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-header">Histórico de Empréstimos</div>
            <div class="card-body">
                @if($book->users->isEmpty())
                <p>Nenhum empréstimo registrado.</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Data de Empréstimo</th>
                            <th>Data de Devolução</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book->users as $user)
                        <tr>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->pivot->borrowed_at }}</td>
                            <td>{{ $user->pivot->returned_at ?? 'Em Aberto' }}</td>
                            <td>
                                @if(is_null($user->pivot->returned_at))
                                <form action="{{ route('borrowings.return', $user->pivot->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-warning btn-sm">Devolver</button>
                                </form>
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