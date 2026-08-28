@extends('layouts.app')
@section('title', 'Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-journals me-2 text-primary"></i>Acervo de Livros</h4>
    <a href="{{ route('livros.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo Livro</a>
</div>

<!-- Filters -->
<form method="GET" class="card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por título, autor ou ISBN..." value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="genero" class="form-select">
                <option value="">Todos os gêneros</option>
                @foreach($generos as $g)
                    <option value="{{ $g }}" {{ request('genero') == $g ? 'selected' : '' }}>{{ $g }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100"><i class="bi bi-search me-1"></i>Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary w-100">Limpar</a>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Gênero</th>
                    <th class="text-center">Disponível</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($livros as $livro)
                <tr>
                    <td><a href="{{ route('livros.show', $livro) }}" class="text-decoration-none fw-medium">{{ $livro->titulo }}</a></td>
                    <td>{{ $livro->autor }}</td>
                    <td><code>{{ $livro->isbn }}</code></td>
                    <td>{{ $livro->genero ?? '—' }}</td>
                    <td class="text-center">
                        @if($livro->isDisponivel())
                            <span class="badge badge-disponivel rounded-pill px-2">{{ $livro->quantidade_disponivel }}/{{ $livro->quantidade_total }}</span>
                        @else
                            <span class="badge badge-esgotado rounded-pill px-2">Esgotado</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('livros.destroy', $livro) }}" class="d-inline" onsubmit="return confirm('Excluir este livro?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Nenhum livro encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($livros->hasPages())
    <div class="card-footer bg-white">{{ $livros->links() }}</div>
    @endif
</div>
@endsection
