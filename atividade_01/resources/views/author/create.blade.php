@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Autor</h1>

    <form action="{{ route('author.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" value="{{ old('birth_date') }}" required>
            @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar</button>
        <a href="{{ route('author.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
    </form>
</div>
@endsection
