<h1>Lista de Alunos</h1>

<a href="{{ route('alunos.create') }}">Novo Aluno</a>

<ul>
@foreach($alunos as $aluno)
    <li>
        {{ $aluno->nome }} - {{ $aluno->curso }}
        <a href="{{ route('alunos.edit', $aluno->id) }}">Editar</a>

        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </li>
@endforeach
</ul>
