@extends('layouts.app')
@section('title', $membro->nome)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-person me-2 text-primary"></i>Perfil do Membro</h4>
    <div>
        <a href="{{ route('membros.edit', $membro) }}" class="btn btn-outline-primary me-2"><i class="bi bi-pencil me-1"></i>Editar</a>
        <a href="{{ route('membros.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card p-4">
            <div class="text-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                     style="width:64px;height:64px">
                    <i class="bi bi-person-fill fs-3 text-primary"></i>
                </div>
                <h5 class="mb-0 fw-bold">{{ $membro->nome }}</h5>
                <span class="badge badge-{{ $membro->status }} rounded-pill px-2 mt-1">{{ ucfirst($membro->status) }}</span>
            </div>
            <table class="table table-borderless table-sm mb-0">
                <tr><th class="text-muted">E-mail</th><td>{{ $membro->email }}</td></tr>
                <tr><th class="text-muted">CPF</th><td><code>{{ $membro->cpf }}</code></td></tr>
                <tr><th class="text-muted">Telefone</th><td>{{ $membro->telefone ?? '—' }}</td></tr>
                <tr><th class="text-muted">Nascimento</th><td>{{ $membro->data_nascimento ? $membro->data_nascimento->format('d/m/Y') : '—' }}</td></tr>
                <tr><th class="text-muted">Endereço</th><td>{{ $membro->endereco ?? '—' }}</td></tr>
                <tr><th class="text-muted">Cadastro</th><td>{{ $membro->created_at->format('d/m/Y') }}</td></tr>
            </table>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <strong>Histórico de Empréstimos</strong>
                <span class="badge bg-secondary ms-2">{{ $membro->emprestimos->count() }}</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Livro</th><th>Emprestado</th><th>Devolver até</th><th>Devolução</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($membro->emprestimos->sortByDesc('data_emprestimo') as $e)
                        <tr>
                            <td class="small">{{ Str::limit($e->livro->titulo, 28) }}</td>
                            <td class="small">{{ $e->data_emprestimo->format('d/m/Y') }}</td>
                            <td class="small">{{ $e->data_prevista_devolucao->format('d/m/Y') }}</td>
                            <td class="small">{{ $e->data_devolucao ? $e->data_devolucao->format('d/m/Y') : '—' }}</td>
                            <td><span class="badge badge-{{ $e->status }} rounded-pill px-2">{{ ucfirst($e->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Nenhum empréstimo registrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
