<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LivroController extends Controller
{
    public function index(Request $request): View
    {
        $query = Livro::query();

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('titulo', 'like', "%{$busca}%")
                  ->orWhere('autor', 'like', "%{$busca}%")
                  ->orWhere('isbn', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        $livros  = $query->orderBy('titulo')->paginate(10)->withQueryString();
        $generos = Livro::select('genero')->distinct()->whereNotNull('genero')->pluck('genero');

        return view('livros.index', compact('livros', 'generos'));
    }

    public function create(): View
    {
        return view('livros.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titulo'               => 'required|string|max:255',
            'autor'                => 'required|string|max:255',
            'isbn'                 => 'required|string|max:20|unique:livros,isbn',
            'editora'              => 'nullable|string|max:255',
            'ano_publicacao'       => 'nullable|integer|min:1000|max:' . date('Y'),
            'genero'               => 'nullable|string|max:100',
            'quantidade_total'     => 'required|integer|min:1',
        ]);

        $data['quantidade_disponivel'] = $data['quantidade_total'];

        Livro::create($data);

        return redirect()->route('livros.index')
            ->with('success', 'Livro cadastrado com sucesso!');
    }

    public function show(Livro $livro): View
    {
        $livro->load(['emprestimos.membro']);
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro): View
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro): RedirectResponse
    {
        $data = $request->validate([
            'titulo'           => 'required|string|max:255',
            'autor'            => 'required|string|max:255',
            'isbn'             => 'required|string|max:20|unique:livros,isbn,' . $livro->id,
            'editora'          => 'nullable|string|max:255',
            'ano_publicacao'   => 'nullable|integer|min:1000|max:' . date('Y'),
            'genero'           => 'nullable|string|max:100',
            'quantidade_total' => 'required|integer|min:1',
        ]);

        $diff = $data['quantidade_total'] - $livro->quantidade_total;
        $data['quantidade_disponivel'] = max(0, $livro->quantidade_disponivel + $diff);

        $livro->update($data);

        return redirect()->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro): RedirectResponse
    {
        if ($livro->emprestimos()->whereIn('status', ['ativo', 'atrasado'])->exists()) {
            return back()->with('error', 'Não é possível excluir um livro com empréstimos ativos.');
        }

        $livro->delete();

        return redirect()->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
