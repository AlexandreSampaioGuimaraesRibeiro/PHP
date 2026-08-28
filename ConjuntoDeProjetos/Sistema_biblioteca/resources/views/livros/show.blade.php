@extends('layouts.app')
@section('title', $livro->titulo)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-book me-2 text-primary"></i>Detalhes do Livro</h4>
    <div>
        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-outline-primary me-2"><i class="bi bi-pencil me-1"></i>Editar</a>
        <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-5">
        <div class="card p-4">
            <h5 class="fw-bold mb-3">{{ $livro->titulo }}</h5>
            <table class="table table-borderless table-sm mb-0">
                <tr><th class="text-muted" style="width:130px">Autor</th><td>{{ $livro->autor }}</td></tr>
                <tr><th class="text-muted">ISBN</th><td><code>{{ $livro->isbn }}</code></td></tr>
                <tr><th class="text-muted">Editora</th><td>{{ $livro->editora ?? '—' }}</td></tr>
                <tr><th class="text-muted">Ano</th><td>{{ $livro->ano_publicacao ?? '—' }}</td></tr>
                <tr><th class="text-muted">Gênero</th><td>{{ $livro->genero ?? '—' }}</td></tr>
                <tr>
                    <th class="text-muted">Disponibilidade</th>
                    <td>
                        @if($livro->isDisponivel())
                            <span class="badge badge-disponivel rounded-pill px-2">{{ $livro->quantidade_disponivel }}/{{ $livro->quantidade_total }} disponíveis</span>
                        @else
                            <span class="badge badge-esgotado rounded-pill px-2">Esgotado</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white py-3">
                <strong>Histórico de Empréstimos</strong>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Membro</th><th>Emprestado em</th><th>Devolver até</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($livro->emprestimos->sortByDesc('data_emprestimo') as $e)
                        <tr>
                            <td class="small">{{ $e->membro->nome }}</td>
                            <td class="small">{{ $e->data_emprestimo->format('d/m/Y') }}</td>
                            <td class="small">{{ $e->data_prevista_devolucao->format('d/m/Y') }}</td>
                            <td><span class="badge badge-{{ $e->status }} rounded-pill px-2">{{ ucfirst($e->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Nenhum empréstimo registrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
