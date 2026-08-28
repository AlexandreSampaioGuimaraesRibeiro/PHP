@extends('layouts.app')
@section('title', 'Detalhes do Empréstimo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-file-text me-2 text-primary"></i>Detalhes do Empréstimo</h4>
    <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>

<div class="card p-4" style="max-width:600px">
    <div class="mb-3">
        <span class="badge badge-{{ $emprestimo->status }} rounded-pill px-3 py-2 fs-6">{{ ucfirst($emprestimo->status) }}</span>
    </div>
    <table class="table table-borderless mb-0">
        <tr>
            <th class="text-muted" style="width:160px">Livro</th>
            <td><a href="{{ route('livros.show', $emprestimo->livro) }}">{{ $emprestimo->livro->titulo }}</a></td>
        </tr>
        <tr>
            <th class="text-muted">Autor</th>
            <td>{{ $emprestimo->livro->autor }}</td>
        </tr>
        <tr>
            <th class="text-muted">Membro</th>
            <td><a href="{{ route('membros.show', $emprestimo->membro) }}">{{ $emprestimo->membro->nome }}</a></td>
        </tr>
        <tr>
            <th class="text-muted">Data Empréstimo</th>
            <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th class="text-muted">Devolver até</th>
            <td class="{{ $emprestimo->status === 'atrasado' ? 'text-danger fw-bold' : '' }}">
                {{ $emprestimo->data_prevista_devolucao->format('d/m/Y') }}
                @if($emprestimo->isAtrasado())
                    <span class="badge bg-danger ms-1">{{ now()->diffInDays($emprestimo->data_prevista_devolucao) }} dias de atraso</span>
                @endif
            </td>
        </tr>
        @if($emprestimo->data_devolucao)
        <tr>
            <th class="text-muted">Devolvido em</th>
            <td>{{ $emprestimo->data_devolucao->format('d/m/Y') }}</td>
        </tr>
        @endif
        @if($emprestimo->multa > 0)
        <tr>
            <th class="text-muted">Multa</th>
            <td class="text-danger fw-bold">R$ {{ number_format($emprestimo->multa, 2, ',', '.') }}</td>
        </tr>
        @endif
        @if($emprestimo->observacoes)
        <tr>
            <th class="text-muted">Observações</th>
            <td>{{ $emprestimo->observacoes }}</td>
        </tr>
        @endif
    </table>

    @if($emprestimo->status !== 'devolvido')
    <div class="mt-4">
        <form method="POST" action="{{ route('emprestimos.devolver', $emprestimo) }}"
              onsubmit="return confirm('Confirmar devolução?')">
            @csrf @method('PATCH')
            <button class="btn btn-success"><i class="bi bi-check2-circle me-1"></i>Confirmar Devolução</button>
        </form>
    </div>
    @endif
</div>
@endsection
