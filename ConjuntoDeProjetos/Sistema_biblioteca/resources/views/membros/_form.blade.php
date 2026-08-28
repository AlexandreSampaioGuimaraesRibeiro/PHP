<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-medium">Nome Completo <span class="text-danger">*</span></label>
        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror"
               value="{{ old('nome', $membro->nome ?? '') }}" required>
        @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-medium">CPF <span class="text-danger">*</span></label>
        <input type="text" name="cpf" class="form-control @error('cpf') is-invalid @enderror"
               value="{{ old('cpf', $membro->cpf ?? '') }}" placeholder="000.000.000-00" required>
        @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">E-mail <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $membro->email ?? '') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">Telefone</label>
        <input type="text" name="telefone" class="form-control"
               value="{{ old('telefone', $membro->telefone ?? '') }}" placeholder="(11) 99999-9999">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-medium">Data de Nascimento</label>
        <input type="date" name="data_nascimento" class="form-control"
               value="{{ old('data_nascimento', isset($membro) && $membro->data_nascimento ? $membro->data_nascimento->format('Y-m-d') : '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach(['ativo' => 'Ativo', 'inativo' => 'Inativo', 'suspenso' => 'Suspenso'] as $val => $label)
                <option value="{{ $val }}" {{ old('status', $membro->status ?? 'ativo') == $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-medium">Endereço</label>
        <input type="text" name="endereco" class="form-control"
               value="{{ old('endereco', $membro->endereco ?? '') }}">
    </div>
</div>
