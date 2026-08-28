<h1>Novo Agendamento</h1>

<form action="{{ route('agendamentos.store') }}" method="POST">
    @csrf
    <input type="text" name="cliente" placeholder="Cliente">
    <input type="date" name="data">
    <input type="time" name="hora">
    <textarea name="descricao" placeholder="Descrição"></textarea>
    <button type="submit">Salvar</button>
</form>
