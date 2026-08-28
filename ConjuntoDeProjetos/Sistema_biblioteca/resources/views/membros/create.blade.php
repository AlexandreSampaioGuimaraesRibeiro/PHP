@extends('layouts.app')
@section('title', 'Novo Membro')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2 text-primary"></i>Novo Membro</h4>
    <a href="{{ route('membros.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>
<div class="card p-4" style="max-width:680px">
    <form method="POST" action="{{ route('membros.store') }}">
        @csrf
        @include('membros._form')
        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg me-1"></i>Salvar</button>
    </form>
</div>
@endsection
