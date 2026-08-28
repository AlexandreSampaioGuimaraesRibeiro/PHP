<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
</head>
<body>

    <h2>Cadastro de Produto</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('estoque.store') }}" method="POST">
        @csrf

        <label>Nome:</label><br>
        <input type="text" name="nome"><br><br>

        <label>Preço:</label><br>
        <input type="text" name="preco"><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="quantidade"><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria"><br><br>

        <label>Fornecedor:</label><br>
        <input type="text" name="fornecedor"><br><br>

        <button type="submit">Salvar Produto</button>
    </form>

</body>
</html>