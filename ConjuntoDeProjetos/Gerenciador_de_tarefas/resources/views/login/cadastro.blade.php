<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand: #1D9E75;
            --brand-dark: #0F6E56;
            --brand-light: #E1F5EE;
            --surface: #ffffff;
            --bg: #f4f6f3;
            --text: #1a1a18;
            --muted: #6b6b68;
            --border: #d0d4cd;
            --danger: #A32D2D;
            --danger-bg: #FCEBEB;
            --radius: 12px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 900px;
            width: 100%;
            background: var(--surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0,0,0,0.08);
        }

        .panel-left {
            background: var(--brand-dark);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .brand {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .brand span {
            color: #9FE1CB;
        }

        .panel-tagline {
            position: relative;
            z-index: 1;
        }

        .panel-tagline h2 {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1rem;
            letter-spacing: -0.03em;
        }

        .panel-tagline p {
            color: #9FE1CB;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .panel-right {
            padding: 3rem 2.5rem;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
            margin-bottom: 0.3rem;
        }

        .form-header p {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .form-header p a {
            color: var(--brand-dark);
            text-decoration: none;
            font-weight: 500;
        }

        .form-header p a:hover {
            text-decoration: underline;
        }

        .alert-success {
            background: var(--brand-light);
            border-left: 3px solid var(--brand);
            color: var(--brand-dark);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.88rem;
            margin-bottom: 1.5rem;
        }

        .field {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.93rem;
            color: var(--text);
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(29,158,117,0.12);
        }

        input.is-invalid {
            border-color: var(--danger);
        }

        .error-msg {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.35rem;
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background: var(--brand-dark);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 0.5rem;
        }

        .btn-primary:hover { background: var(--brand); }
        .btn-primary:active { transform: scale(0.99); }

        @media (max-width: 640px) {
            .wrapper { grid-template-columns: 1fr; }
            .panel-left { display: none; }
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- Painel esquerdo decorativo --}}
    <div class="panel-left">
        <div class="brand">app<span>.</span></div>
        <div class="panel-tagline">
            <h2>Crie sua conta gratuitamente</h2>
            <p>Acesse todos os recursos em segundos. Simples, rápido e seguro.</p>
        </div>
    </div>

    {{-- Formulário de cadastro --}}
    <div class="panel-right">

        <div class="form-header">
            <h1>Cadastro</h1>
            <p>Já tem uma conta? <a href="{{ route('usuario.index') }}">Entrar</a></p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('usuario.store') }}">
            @csrf

            <div class="field">
                <label for="nome">Nome completo</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="{{ old('nome') }}"
                    placeholder="Seu nome"
                    class="{{ $errors->has('nome') ? 'is-invalid' : '' }}"
                    autocomplete="name"
                >
                @error('nome')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="seu@email.com"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    autocomplete="email"
                >
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    autocomplete="new-password"
                >
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Criar conta</button>

        </form>
    </div>

</div>

</body>
</html>