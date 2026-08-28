@extends('layouts.app')
@section('title', 'Novo Livro')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>Novo Livro</h4>
    <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>

<div class="card p-4" style="max-width:680px">
    <form method="POST" action="{{ route('livros.store') }}">
        @csrf
        @include('livros._form')
        <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-check-lg me-1"></i>Salvar</button>
    </form>
</div>
@endsection
