<h1>Editar Aluno</h1>

<form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nome" value="{{ $aluno->nome }}">
    <input type="email" name="email" value="{{ $aluno->email }}">
    <input type="text" name="matricula" value="{{ $aluno->matricula }}">
    <input type="text" name="curso" value="{{ $aluno->curso }}">

    <button type="submit">Atualizar</button>
</form>
