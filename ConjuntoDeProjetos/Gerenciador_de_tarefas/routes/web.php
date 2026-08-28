<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get("/", [UsuarioController::class, 'index'])->name('usuario.index');

// ── Cadastro ──────────────────────────────────────────────────────────────
// Exibe o formulário de cadastro
Route::get('/login/cadastro', [UsuarioController::class, 'create'])
    ->name('usuario.create');

// Processa o formulário de cadastro
Route::post('/login/cadastro', [UsuarioController::class, 'store'])
    ->name('usuario.store');

// ── Login ─────────────────────────────────────────────────────────────────


// Processa o login
Route::post('/login', [UsuarioController::class, 'show'])
    ->name('usuario.show');

// ── Área autenticada ──────────────────────────────────────────────────────
// Página inicial após login bem-sucedido

Route::get('/usuario/index', [TarefaController::class,'index'])->name('tarefa.index')
->middleware('auth');

Route::post('/usuario/index', [TarefaController::class, 'store'])->name('tarefa.store');

Route::post('/usuario/index', [TarefaController::class, 'edit'])->name('tarefa.edit');