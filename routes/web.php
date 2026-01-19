<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;

// Locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);

// Protected Routes
Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  
  // Dashboard / Home
  Route::get('/', [HomePage::class, 'index'])->name('pages-home');
  Route::get('/dashboard', [HomePage::class, 'index'])->name('dashboard'); // Alias for Jetstream default

  // Resources
  Route::resource('clientes', \App\Http\Controllers\ClienteController::class);
  Route::resource('produtos', \App\Http\Controllers\ProdutoController::class);
  Route::resource('maquinas', \App\Http\Controllers\MaquinaController::class);
  Route::resource('vendas', \App\Http\Controllers\VendaController::class);
  Route::resource('users', \App\Http\Controllers\UserController::class);
  
  // Stock Actions
  Route::post('estoque', [\App\Http\Controllers\EstoqueController::class, 'store'])->name('estoque.store');
  Route::delete('estoque/{id}', [\App\Http\Controllers\EstoqueController::class, 'destroy'])->name('estoque.destroy');

  // Reports
  Route::get('relatorios/vendas-por-cliente', [\App\Http\Controllers\RelatorioController::class, 'vendasPorCliente'])->name('relatorios.vendas_por_cliente');
});
