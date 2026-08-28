<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Usuario $usuario)
    {
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'=> ['string','required','max:255'],
            'email'=> ['string','required','max:255'],
            'password'=> ['string','required','max:255'],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        Usuario::create($validated);
        return redirect()->route('usuario.index')->with('success','Usuário criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $usuario = Usuario::where('email', $validated['email'])->first();

        if ($usuario && Hash::check($validated['password'], $usuario->password)) {
            return redirect()->route('tarefa.index')->with('success','Login efetuado com sucesso');
        }

        return redirect()->route('login')->with('error','Credenciais inválidas');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
