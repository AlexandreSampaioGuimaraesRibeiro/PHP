<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MembroController extends Controller
{
    public function index(Request $request): View
    {
        $query = Membro::query();

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('cpf', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $membros = $query->orderBy('nome')->paginate(10)->withQueryString();

        return view('membros.index', compact('membros'));
    }

    public function create(): View
    {
        return view('membros.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nome'            => 'required|string|max:255',
            'email'           => 'required|email|unique:membros,email',
            'telefone'        => 'nullable|string|max:20',
            'cpf'             => 'required|string|max:14|unique:membros,cpf',
            'data_nascimento' => 'nullable|date|before:today',
            'endereco'        => 'nullable|string|max:255',
            'status'          => 'required|in:ativo,inativo,suspenso',
        ]);

        Membro::create($data);

        return redirect()->route('membros.index')
            ->with('success', 'Membro cadastrado com sucesso!');
    }

    public function show(Membro $membro): View
    {
        $membro->load(['emprestimos.livro']);
        return view('membros.show', compact('membro'));
    }

    public function edit(Membro $membro): View
    {
        return view('membros.edit', compact('membro'));
    }

    public function update(Request $request, Membro $membro): RedirectResponse
    {
        $data = $request->validate([
            'nome'            => 'required|string|max:255',
            'email'           => 'required|email|unique:membros,email,' . $membro->id,
            'telefone'        => 'nullable|string|max:20',
            'cpf'             => 'required|string|max:14|unique:membros,cpf,' . $membro->id,
            'data_nascimento' => 'nullable|date|before:today',
            'endereco'        => 'nullable|string|max:255',
            'status'          => 'required|in:ativo,inativo,suspenso',
        ]);

        $membro->update($data);

        return redirect()->route('membros.index')
            ->with('success', 'Membro atualizado com sucesso!');
    }

    public function destroy(Membro $membro): RedirectResponse
    {
        if ($membro->emprestimosAtivos()->exists()) {
            return back()->with('error', 'Não é possível excluir um membro com empréstimos ativos.');
        }

        $membro->delete();

        return redirect()->route('membros.index')
            ->with('success', 'Membro excluído com sucesso!');
    }
}
