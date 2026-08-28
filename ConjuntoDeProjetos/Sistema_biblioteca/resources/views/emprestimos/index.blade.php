@extends('layouts.app')
@section('title', 'Empréstimos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-arrow-left-right me-2 text-primary"></i>Empréstimos</h4>
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo Empréstimo</a>
</div>

<form method="GET" class="card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por livro ou membro..."
                   value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Todos os status</option>
                <option value="ativo"     {{ request('status') == 'ativo'     ? 'selected' : '' }}>Ativo</option>
                <option value="atrasado"  {{ request('status') == 'atrasado'  ? 'selected' : '' }}>Atrasado</option>
                <option value="devolvido" {{ request('status') == 'devolvido' ? 'selected' : '' }}>Devolvido</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100"><i class="bi bi-search me-1"></i>Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary w-100">Limpar</a>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Livro</th>
                    <th>Membro</th>
                    <th>Emprestado</th>
                    <th>Devolver até</th>
                    <th>Devolução</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Multa</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($emprestimos as $e)
                <tr>
                    <td class="small"><a href="{{ route('livros.show', $e->livro) }}" class="text-decoration-none">{{ Str::limit($e->livro->titulo, 28) }}</a></td>
                    <td class="small"><a href="{{ route('membros.show', $e->membro) }}" class="text-decoration-none">{{ Str::limit($e->membro->nome, 20) }}</a></td>
                    <td class="small">{{ $e->data_emprestimo->format('d/m/Y') }}</td>
                    <td class="small {{ $e->status === 'atrasado' ? 'text-danger fw-medium' : '' }}">{{ $e->data_prevista_devolucao->format('d/m/Y') }}</td>
                    <td class="small">{{ $e->data_devolucao ? $e->data_devolucao->format('d/m/Y') : '—' }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $e->status }} rounded-pill px-2">{{ ucfirst($e->status) }}</span>
                    </td>
                    <td class="text-center small">
                        {{ $e->multa > 0 ? 'R$ ' . number_format($e->multa, 2, ',', '.') : '—' }}
                    </td>
                    <td class="text-center">
                        @if($e->status !== 'devolvido')
                        <form method="POST" action="{{ route('emprestimos.devolver', $e) }}" class="d-inline"
                              onsubmit="return confirm('Confirmar devolução?')">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success me-1" title="Devolver"><i class="bi bi-check2-circle"></i></button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('emprestimos.destroy', $e) }}" class="d-inline"
                              onsubmit="return confirm('Excluir este registro?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Excluir"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                        <a href="{{ route('emprestimos.show', $e) }}" class="btn btn-sm btn-outline-secondary" title="Ver detalhes"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Nenhum empréstimo encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($emprestimos->hasPages())
    <div class="card-footer bg-white">{{ $emprestimos->links() }}</div>
    @endif
</div>
@endsection
