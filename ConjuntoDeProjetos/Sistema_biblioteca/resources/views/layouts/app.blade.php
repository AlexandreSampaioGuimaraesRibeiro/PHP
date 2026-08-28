<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Biblioteca') — Sistema de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #1e3a5f; }
        .sidebar .nav-link { color: rgba(255,255,255,.75); border-radius: 6px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,.15); color: #fff; }
        .sidebar .brand { color: #fff; font-size: 1.3rem; font-weight: 700; padding: 1.2rem 1rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar .nav-section { font-size: .7rem; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: 1px; padding: .75rem 1rem .25rem; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.07); border-radius: 10px; }
        .badge-disponivel  { background: #d1fae5; color: #065f46; }
        .badge-esgotado    { background: #fee2e2; color: #991b1b; }
        .badge-ativo       { background: #dbeafe; color: #1e40af; }
        .badge-devolvido   { background: #d1fae5; color: #065f46; }
        .badge-atrasado    { background: #fee2e2; color: #991b1b; }
        .badge-suspenso    { background: #fef3c7; color: #92400e; }
        .badge-inativo     { background: #f3f4f6; color: #374151; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-md-block sidebar py-2">
            <div class="brand"><i class="bi bi-book-half me-2"></i>Biblioteca</div>
            <ul class="nav flex-column mt-2">
                <li class="nav-section">Principal</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-section">Acervo</li>
                <li class="nav-item">
                    <a href="{{ route('livros.index') }}" class="nav-link {{ request()->routeIs('livros.*') ? 'active' : '' }}">
                        <i class="bi bi-journals me-2"></i>Livros
                    </a>
                </li>
                <li class="nav-section">Membros</li>
                <li class="nav-item">
                    <a href="{{ route('membros.index') }}" class="nav-link {{ request()->routeIs('membros.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>Membros
                    </a>
                </li>
                <li class="nav-section">Circulação</li>
                <li class="nav-item">
                    <a href="{{ route('emprestimos.index') }}" class="nav-link {{ request()->routeIs('emprestimos.*') ? 'active' : '' }}">
                        <i class="bi bi-arrow-left-right me-2"></i>Empréstimos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('emprestimos.create') }}" class="nav-link">
                        <i class="bi bi-plus-circle me-2"></i>Novo Empréstimo
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="col-md-10 ms-sm-auto px-4 py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
