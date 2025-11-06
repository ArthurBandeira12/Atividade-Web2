@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Editora</h1>

    <form action="{{ route('publisher.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address') }}" required>
            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar</button>
        <a href="{{ route('publisher.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
    </form>
</div>
@endsection
