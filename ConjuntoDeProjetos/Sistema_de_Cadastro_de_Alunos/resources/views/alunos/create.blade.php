<h1>Cadastrar Aluno</h1>

<form action="{{ route('alunos.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="matricula" placeholder="Matrícula">
    <input type="text" name="curso" placeholder="Curso">
    <button type="submit">Salvar</button>
</form>
