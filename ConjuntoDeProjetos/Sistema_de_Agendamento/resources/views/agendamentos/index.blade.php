<h1>Lista de Agendamentos</h1>

<a href="{{ route('agendamentos.create') }}">Novo Agendamento</a>

<ul>
@foreach($agendamentos as $agendamento)
    <li>
        {{ $agendamento->cliente }} - {{ $agendamento->data }} {{ $agendamento->hora }}

        <a href="{{ route('agendamentos.edit', $agendamento->id) }}">Editar</a>

        <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </li>
@endforeach
</ul>
