<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.index');
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
            'email'=> ['required','string','max:255'],
            'password'=> ['required','string','max:255'],
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.'
        ]);
        $email = $validated['email'];
        $password = $validated['password'];
        $usuario = Usuario::where('email', $email)->first();
        if ($usuario && Hash::check($password, $usuario->password)) {
            session('usuario_id', $usuario->id);
            session()->save();
            return redirect()->route('estoque.index')->with('success','Bem vindo');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }
}
