<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
               value="{{ old('titulo', $livro->titulo ?? '') }}" required>
        @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">Autor <span class="text-danger">*</span></label>
        <input type="text" name="autor" class="form-control @error('autor') is-invalid @enderror"
               value="{{ old('autor', $livro->autor ?? '') }}" required>
        @error('autor')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">ISBN <span class="text-danger">*</span></label>
        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
               value="{{ old('isbn', $livro->isbn ?? '') }}" required>
        @error('isbn')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">Editora</label>
        <input type="text" name="editora" class="form-control"
               value="{{ old('editora', $livro->editora ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-medium">Ano de Publicação</label>
        <input type="number" name="ano_publicacao" class="form-control"
               value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}"
               min="1000" max="{{ date('Y') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-medium">Quantidade <span class="text-danger">*</span></label>
        <input type="number" name="quantidade_total" class="form-control @error('quantidade_total') is-invalid @enderror"
               value="{{ old('quantidade_total', $livro->quantidade_total ?? 1) }}" min="1" required>
        @error('quantidade_total')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-medium">Gênero</label>
        <input type="text" name="genero" class="form-control"
               value="{{ old('genero', $livro->genero ?? '') }}" placeholder="Ex: Romance, Ficção, Técnico…">
    </div>
</div>
