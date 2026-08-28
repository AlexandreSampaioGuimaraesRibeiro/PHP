<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #0d0f14;
            --surface:    #161922;
            --border:     #252933;
            --text:       #e8eaf0;
            --muted:      #6b7280;
            --accent:     #f0c040;
            --danger:     #f0604a;
            --success:    #3ecf8e;
            --info:       #60a5fa;
            --warn:       #fb923c;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        /* ── layout ── */
        .container { max-width: 900px; margin: 0 auto; }

        /* ── header ── */
        header {
            display: flex;
            align-items: baseline;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--accent);
        }
        header span {
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* ── alert ── */
        .alert {
            padding: .75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: .875rem;
            background: color-mix(in srgb, var(--success) 12%, transparent);
            border: 1px solid color-mix(in srgb, var(--success) 30%, transparent);
            color: var(--success);
        }

        /* ── filter tabs ── */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-bottom: 1.75rem;
        }
        .filter-btn {
            padding: .45rem 1rem;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .18s ease;
            display: flex;
            align-items: center;
            gap: .45rem;
        }
        .filter-btn:hover { border-color: var(--accent); color: var(--text); }
        .filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #0d0f14;
            font-weight: 700;
        }
        .filter-btn .dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: currentColor;
            opacity: .7;
        }
        .filter-btn[data-status="pendente"]    .dot { background: var(--warn); }
        .filter-btn[data-status="em_andamento"] .dot { background: var(--info); }
        .filter-btn[data-status="concluida"]   .dot { background: var(--success); }
        .filter-btn[data-status="cancelada"]   .dot { background: var(--danger); }
        .filter-btn.active .dot { background: #0d0f14; }

        /* ── task list ── */
        #task-list { display: flex; flex-direction: column; gap: .85rem; }

        /* ── card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem 1.4rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: .6rem 1rem;
            align-items: start;
            transition: border-color .2s, transform .2s;
            animation: fadeIn .25s ease both;
        }
        .card:hover { border-color: #353b4a; transform: translateY(-1px); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-main { display: flex; flex-direction: column; gap: .35rem; }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
        }
        .card-desc {
            font-size: .83rem;
            color: var(--muted);
            line-height: 1.5;
        }
        .card-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: .2rem;
        }

        /* badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .25rem .65rem;
            border-radius: 999px;
            font-size: .73rem;
            font-weight: 600;
            letter-spacing: .02em;
            text-transform: uppercase;
        }
        .badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-pendente    { background: color-mix(in srgb,var(--warn) 15%,transparent); color:var(--warn); }
        .badge-em_andamento{ background: color-mix(in srgb,var(--info) 15%,transparent); color:var(--info); }
        .badge-concluida   { background: color-mix(in srgb,var(--success) 15%,transparent); color:var(--success); }
        .badge-cancelada   { background: color-mix(in srgb,var(--danger) 15%,transparent); color:var(--danger); }

        .badge-alta  { background: color-mix(in srgb,var(--danger) 12%,transparent); color:var(--danger); }
        .badge-media { background: color-mix(in srgb,var(--warn) 12%,transparent); color:var(--warn); }
        .badge-baixa { background: color-mix(in srgb,var(--success) 12%,transparent); color:var(--success); }

        .due-date {
            font-size: .75rem;
            color: var(--muted);
        }

        /* ── card actions ── */
        .card-actions {
            display: flex;
            gap: .5rem;
            align-items: center;
            flex-shrink: 0;
        }
        .btn-icon {
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: .45rem .65rem;
            cursor: pointer;
            color: var(--muted);
            font-size: .8rem;
            transition: all .15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-icon:hover { background: var(--border); color: var(--text); }
        .btn-icon.delete:hover { border-color: var(--danger); color: var(--danger); background: color-mix(in srgb,var(--danger) 10%,transparent); }

        /* ── empty state ── */
        .empty {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--muted);
            display: none;
        }
        .empty svg { margin-bottom: 1rem; opacity: .3; }
        .empty p { font-size: .95rem; }

        /* ── count ── */
        .count-label {
            font-size: .78rem;
            color: var(--muted);
            margin-bottom: 1rem;
        }
        #visible-count { color: var(--accent); font-weight: 700; }
    </style>
</head>
<body>
<div class="container">

    <header>
        <h1>Tarefas</h1>
        <span>Bem vindo</span>
    </header>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    {{-- ── Filtros ── --}}
    <div class="filters">
        <button class="filter-btn active" data-status="todos">
            <span class="dot"></span> Todas
        </button>
        <button class="filter-btn" data-status="pendente">
            <span class="dot"></span> Pendente
        </button>
        <button class="filter-btn" data-status="em_andamento">
            <span class="dot"></span> Em Andamento
        </button>
        <button class="filter-btn" data-status="concluida">
            <span class="dot"></span> Concluída
        </button>
        <button class="filter-btn" data-status="cancelada">
            <span class="dot"></span> Cancelada
        </button>
    </div>

    <p class="count-label">Exibindo <span id="visible-count">{{ $tarefas->count() }}</span> tarefa(s)</p>

    {{-- ── Lista ── --}}
    <div id="task-list">
        @forelse($tarefas as $tarefa)
            <div class="card" data-status="{{ $tarefa->status }}">
                <div class="card-main">
                    <span class="card-title">{{ $tarefa->titulo }}</span>
                    <span class="card-desc">{{ $tarefa->descricao }}</span>
                    <div class="card-meta">
                        {{-- Badge status --}}
                        <span class="badge badge-{{ $tarefa->status }}">
                            {{ ucfirst(str_replace('_', ' ', $tarefa->status)) }}
                        </span>
                        {{-- Badge prioridade --}}
                        <span class="badge badge-{{ strtolower($tarefa->prioridade) }}">
                            {{ ucfirst($tarefa->prioridade) }}
                        </span>
                        {{-- Data de entrega --}}
                        <span class="due-date">
                            📅 {{ \Carbon\Carbon::parse($tarefa->data_de_entrega)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                <div class="card-actions">
                    {{-- Editar --}}
                    <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn-icon" title="Editar">
                        ✏️
                    </a>
                    {{-- Deletar --}}
                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
                          onsubmit="return confirm('Deletar esta tarefa?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon delete" title="Deletar">🗑️</button>
                    </form>
                </div>
            </div>
        @empty
            {{-- nenhuma tarefa no banco --}}
        @endforelse
    </div>

    {{-- Estado vazio (controlado pelo JS) --}}
    <div class="empty" id="empty-state">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        <p>Nenhuma tarefa encontrada para este filtro.</p>
    </div>

</div>

<script>
    const buttons   = document.querySelectorAll('.filter-btn');
    const cards     = document.querySelectorAll('.card');
    const emptyEl   = document.getElementById('empty-state');
    const countEl   = document.getElementById('visible-count');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.status;
            let visible  = 0;

            cards.forEach((card, i) => {
                const match = filter === 'todos' || card.dataset.status === filter;
                card.style.display = match ? '' : 'none';
                if (match) {
                    card.style.animationDelay = (visible * 0.04) + 's';
                    visible++;
                }
            });

            countEl.textContent = visible;
            emptyEl.style.display = visible === 0 ? 'block' : 'none';
        });
    });
</script>
</body>
</html>