@extends('layouts.app')
@section('title', 'Membros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-people me-2 text-primary"></i>Membros</h4>
    <a href="{{ route('membros.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo Membro</a>
</div>

<form method="GET" class="card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome, e-mail ou CPF..."
                   value="{{ request('busca') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Todos os status</option>
                <option value="ativo"    {{ request('status') == 'ativo'    ? 'selected' : '' }}>Ativo</option>
                <option value="inativo"  {{ request('status') == 'inativo'  ? 'selected' : '' }}>Inativo</option>
                <option value="suspenso" {{ request('status') == 'suspenso' ? 'selected' : '' }}>Suspenso</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100"><i class="bi bi-search me-1"></i>Buscar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('membros.index') }}" class="btn btn-outline-secondary w-100">Limpar</a>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($membros as $membro)
                <tr>
                    <td><a href="{{ route('membros.show', $membro) }}" class="text-decoration-none fw-medium">{{ $membro->nome }}</a></td>
                    <td>{{ $membro->email }}</td>
                    <td><code>{{ $membro->cpf }}</code></td>
                    <td>{{ $membro->telefone ?? '—' }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $membro->status }} rounded-pill px-2">{{ ucfirst($membro->status) }}</span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('membros.edit', $membro) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('membros.destroy', $membro) }}" class="d-inline"
                              onsubmit="return confirm('Excluir este membro?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Nenhum membro encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($membros->hasPages())
    <div class="card-footer bg-white">{{ $membros->links() }}</div>
    @endif
</div>
@endsection
