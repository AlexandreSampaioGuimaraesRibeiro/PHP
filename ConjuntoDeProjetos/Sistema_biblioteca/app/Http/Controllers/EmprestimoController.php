<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Membro;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmprestimoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Emprestimo::with(['livro', 'membro']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->whereHas('livro', fn ($q) => $q->where('titulo', 'like', "%{$busca}%"))
                  ->orWhereHas('membro', fn ($q) => $q->where('nome', 'like', "%{$busca}%"));
        }

        // Automatically mark overdue loans
        Emprestimo::where('status', 'ativo')
            ->where('data_prevista_devolucao', '<', Carbon::today())
            ->update(['status' => 'atrasado']);

        $emprestimos = $query->orderByDesc('data_emprestimo')->paginate(10)->withQueryString();

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create(): View
    {
        $livros  = Livro::where('quantidade_disponivel', '>', 0)->orderBy('titulo')->get();
        $membros = Membro::where('status', 'ativo')->orderBy('nome')->get();

        return view('emprestimos.create', compact('livros', 'membros'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'livro_id'               => 'required|exists:livros,id',
            'membro_id'              => 'required|exists:membros,id',
            'data_emprestimo'        => 'required|date',
            'data_prevista_devolucao'=> 'required|date|after:data_emprestimo',
            'observacoes'            => 'nullable|string',
        ]);

        $livro  = Livro::findOrFail($data['livro_id']);
        $membro = Membro::findOrFail($data['membro_id']);

        if (! $livro->isDisponivel()) {
            return back()->with('error', 'Este livro não está disponível no momento.');
        }

        if ($membro->status !== 'ativo') {
            return back()->with('error', 'Apenas membros ativos podem realizar empréstimos.');
        }

        $data['status'] = 'ativo';
        $data['multa']  = 0;

        Emprestimo::create($data);
        $livro->decrement('quantidade_disponivel');

        return redirect()->route('emprestimos.index')
            ->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function show(Emprestimo $emprestimo): View
    {
        $emprestimo->load(['livro', 'membro']);
        return view('emprestimos.show', compact('emprestimo'));
    }

    public function devolver(Emprestimo $emprestimo): RedirectResponse
    {
        if ($emprestimo->status === 'devolvido') {
            return back()->with('error', 'Este empréstimo já foi devolvido.');
        }

        $multa = $emprestimo->calcularMulta();

        $emprestimo->update([
            'status'           => 'devolvido',
            'data_devolucao'   => Carbon::today(),
            'multa'            => $multa,
        ]);

        $emprestimo->livro->increment('quantidade_disponivel');

        $msg = 'Livro devolvido com sucesso!';
        if ($multa > 0) {
            $msg .= " Multa por atraso: R$ " . number_format($multa, 2, ',', '.');
        }

        return redirect()->route('emprestimos.index')->with('success', $msg);
    }

    public function destroy(Emprestimo $emprestimo): RedirectResponse
    {
        if ($emprestimo->status !== 'devolvido') {
            return back()->with('error', 'Só é possível excluir empréstimos já devolvidos.');
        }

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')
            ->with('success', 'Registro excluído com sucesso!');
    }
}
