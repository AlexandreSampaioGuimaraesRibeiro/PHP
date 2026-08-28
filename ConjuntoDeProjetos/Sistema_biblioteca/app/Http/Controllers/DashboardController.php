<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Membro;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_livros'         => Livro::count(),
            'livros_disponiveis'   => Livro::where('quantidade_disponivel', '>', 0)->count(),
            'total_membros'        => Membro::where('status', 'ativo')->count(),
            'emprestimos_ativos'   => Emprestimo::whereIn('status', ['ativo', 'atrasado'])->count(),
            'emprestimos_atrasados'=> Emprestimo::where('status', 'atrasado')->count(),
            'devolucoes_hoje'      => Emprestimo::where('data_prevista_devolucao', Carbon::today())
                                        ->where('status', 'ativo')->count(),
        ];

        $emprestimosRecentes = Emprestimo::with(['livro', 'membro'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $atrasados = Emprestimo::with(['livro', 'membro'])
            ->where('status', 'atrasado')
            ->orderBy('data_prevista_devolucao')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'emprestimosRecentes', 'atrasados'));
    }
}
