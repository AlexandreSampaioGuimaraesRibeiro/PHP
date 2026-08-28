<h1>Editar Agendamento</h1>

<form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="cliente" value="{{ $agendamento->cliente }}">
    <input type="date" name="data" value="{{ $agendamento->data }}">
    <input type="time" name="hora" value="{{ $agendamento->hora }}">
    <textarea name="descricao">{{ $agendamento->descricao }}</textarea>

    <button type="submit">Atualizar</button>
</form>
