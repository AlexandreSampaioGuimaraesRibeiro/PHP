@extends('layouts.app')
@section('title', 'Novo Empréstimo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>Novo Empréstimo</h4>
    <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Voltar</a>
</div>

<div class="card p-4" style="max-width:680px">
    <form method="POST" action="{{ route('emprestimos.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium">Livro <span class="text-danger">*</span></label>
                <select name="livro_id" class="form-select @error('livro_id') is-invalid @enderror" required>
                    <option value="">— Selecione um livro —</option>
                    @foreach($livros as $livro)
                        <option value="{{ $livro->id }}" {{ old('livro_id') == $livro->id ? 'selected' : '' }}>
                            {{ $livro->titulo }} — {{ $livro->autor }}
                            ({{ $livro->quantidade_disponivel }} disponível{{ $livro->quantidade_disponivel != 1 ? 'is' : '' }})
                        </option>
                    @endforeach
                </select>
                @error('livro_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Membro <span class="text-danger">*</span></label>
                <select name="membro_id" class="form-select @error('membro_id') is-invalid @enderror" required>
                    <option value="">— Selecione um membro —</option>
                    @foreach($membros as $membro)
                        <option value="{{ $membro->id }}" {{ old('membro_id') == $membro->id ? 'selected' : '' }}>
                            {{ $membro->nome }} ({{ $membro->email }})
                        </option>
                    @endforeach
                </select>
                @error('membro_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Data do Empréstimo <span class="text-danger">*</span></label>
                <input type="date" name="data_emprestimo" class="form-control @error('data_emprestimo') is-invalid @enderror"
                       value="{{ old('data_emprestimo', now()->format('Y-m-d')) }}" required>
                @error('data_emprestimo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Devolução Prevista <span class="text-danger">*</span></label>
                <input type="date" name="data_prevista_devolucao" class="form-control @error('data_prevista_devolucao') is-invalid @enderror"
                       value="{{ old('data_prevista_devolucao', now()->addDays(14)->format('Y-m-d')) }}" required>
                @error('data_prevista_devolucao')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Observações</label>
                <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes') }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-check-lg me-1"></i>Registrar Empréstimo</button>
    </form>
</div>
@endsection
