<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>

    <h2>Cadastro de Usuário</h2>

    @if($errors->any())
        <ul style="color: red">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf

        <label>Nome:</label><br>
        <input type="text" name="nome"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="{{ route('login.index') }}">Voltar para login</a>

</body>
</html>