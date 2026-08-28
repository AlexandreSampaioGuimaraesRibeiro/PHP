<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\MembroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('livros', LivroController::class);
Route::resource('membros', MembroController::class);

Route::resource('emprestimos', EmprestimoController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
Route::patch('emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
