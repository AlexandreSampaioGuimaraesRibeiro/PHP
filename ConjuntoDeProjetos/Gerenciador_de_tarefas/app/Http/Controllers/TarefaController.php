<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefa::where(Auth::id())->get();
        return view('usuario.index', compact('tarefas'));
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
        $validated = $request->validate([
            'titulo' => ['required','string','max:255'],
            'descricao'=>['required','string','max:255'],
            'prioridade'=>['required','enum'],
            'data_de_entrega'=>['required','date'],
        ]);
        $validated= $request['status'] ?? 'ativa';
        Tarefa::create($validated);
        return redirect('usuario.index')->with('success','tarefa criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tarefa $tarefa)
    {
        $validated = $request->validate([
            'titulo' => ['required','string','max:255'],
            'descricao'=>['required','string','max:255'],
            'status'=>['required','enum'],
            'prioridade'=>['required','enum'],
            'data_de_entrega'=>['required','date'],
        ]);
        $tarefa->update($validated);
        return redirect('usuario.index')->with('success','tarefa editada com sucesso');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect('usuario.index')->with('success','tarefa deletada com sucesso');
    }
}
