<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("estoque.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'nome' => ['required','string','max:255'],
            'preco'=> ['required','decimal'],
            'descricao'=>['required','string','max:500'],
            'quantidade'=>['required','int'],
            'categoria'=>['required','string','max:255'],
            'fornecedor'=>['required','string','max:255'],
        ]);
        $Estoque=Estoque::create($validated);
        return redirect()->route('estoque.index')->with('success','produto salvo com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estoque $Estoque, Request $request)
    {
        $validated= $request->validate([
            'nome' => ['required','string','max:255'],
            'preco'=> ['required','decimal'],
            'descricao'=>['required','string','max:500'],
            'quantidade'=>['required','int'],
            'categoria'=>['required','string','max:255'],
            'fornecedor'=>['required','string','max:255'],
        ]);
        $Estoque=Estoque::update($validated);
        return redirect()->route('estoque.index')->with('success','produto atualizado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estoque $estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estoque $Estoque)
    {
        $Estoque->delete();
        return redirect()->route('estoque.index')->with('success','Produto deletado com sucesso');
    }
}
