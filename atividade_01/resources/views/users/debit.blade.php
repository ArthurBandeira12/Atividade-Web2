@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Usuários com Débito</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Débito (R$)</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>R$ {{ number_format($user->debit, 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('users.clearDebit', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">
                                Quitar Débito
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum usuário com débito.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
