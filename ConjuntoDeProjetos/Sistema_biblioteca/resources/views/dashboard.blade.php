@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard</h4>
    <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-primary">{{ $stats['total_livros'] }}</div>
            <div class="small text-muted">Total Livros</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-success">{{ $stats['livros_disponiveis'] }}</div>
            <div class="small text-muted">Disponíveis</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-info">{{ $stats['total_membros'] }}</div>
            <div class="small text-muted">Membros Ativos</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-warning">{{ $stats['emprestimos_ativos'] }}</div>
            <div class="small text-muted">Em Aberto</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-danger">{{ $stats['emprestimos_atrasados'] }}</div>
            <div class="small text-muted">Atrasados</div>
        </div>
    </div>
    <div class="col-md-2 col-sm-4 col-6">
        <div class="card text-center p-3">
            <div class="fs-2 fw-bold text-secondary">{{ $stats['devolucoes_hoje'] }}</div>
            <div class="small text-muted">Vencem Hoje</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent loans -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <strong>Empréstimos Recentes</strong>
                <a href="{{ route('emprestimos.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Livro</th>
                            <th>Membro</th>
                            <th>Devolução</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($emprestimosRecentes as $e)
                        <tr>
                            <td class="small">{{ Str::limit($e->livro->titulo, 30) }}</td>
                            <td class="small">{{ Str::limit($e->membro->nome, 20) }}</td>
                            <td class="small">{{ $e->data_prevista_devolucao->format('d/m/Y') }}</td>
                            <td><span class="badge badge-{{ $e->status }} rounded-pill px-2">{{ ucfirst($e->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Nenhum empréstimo ainda.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Overdue -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <strong class="text-danger"><i class="bi bi-exclamation-triangle me-1"></i>Atrasados</strong>
                <a href="{{ route('emprestimos.index', ['status' => 'atrasado']) }}" class="btn btn-sm btn-outline-danger">Ver todos</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Membro</th><th>Livro</th><th>Dias</th></tr>
                    </thead>
                    <tbody>
                        @forelse($atrasados as $e)
                        <tr>
                            <td class="small">{{ Str::limit($e->membro->nome, 18) }}</td>
                            <td class="small">{{ Str::limit($e->livro->titulo, 18) }}</td>
                            <td class="small text-danger fw-bold">{{ now()->diffInDays($e->data_prevista_devolucao) }}d</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Nenhum atraso! 🎉</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
