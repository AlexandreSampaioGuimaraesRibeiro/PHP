<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstoqueController;

/*
|--------------------------------------------------------------------------
| ROTAS DE LOGIN
|--------------------------------------------------------------------------
*/

// tela de login
Route::get('/', [LoginController::class, 'index'])->name('login.index');

// processa login
Route::post('/login', [LoginController::class, 'store'])->name('login.store');


/*
|--------------------------------------------------------------------------
| ROTAS DE CADASTRO
|--------------------------------------------------------------------------
*/

// tela de cadastro
Route::get('/cadastro', [UsuarioController::class, 'index'])->name('usuario.index');

// salvar usuário
Route::post('/cadastro', [UsuarioController::class, 'store'])->name('usuario.store');


/*
|--------------------------------------------------------------------------
| ROTAS DO SISTEMA (ESTOQUE)
|--------------------------------------------------------------------------
*/

// tela principal
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');

// salvar produto
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');

// deletar produto
Route::delete('/estoque/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');