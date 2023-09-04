<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return redirect('login');});

Route::middleware('auth')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->get('/tickets', [App\Http\Controllers\TicketsController::class, 'index'])->name('tickets');
Route::middleware('auth')->get('/chamado/{id}',[App\Http\Controllers\TicketsController::class, 'show'])->name('chamado.show');
Route::middleware('auth')->put('/chamado/{id}', [App\Http\Controllers\TicketsController::class, 'update'])->name('chamado.update');
Route::middleware('auth')->post('/ticket', [App\Http\Controllers\TicketsController::class, 'new'])->name('ticket.new');
Route::middleware('auth')->get('/configuracoes/usuarios', [App\Http\Controllers\ConfiguracoesController::class, 'usuarios'])->name('configuracoes.usuarios');
Route::middleware('auth')->get('/configuracoes/categorias', [App\Http\Controllers\ConfiguracoesController::class, 'categorias'])->name('configuracoes.categorias');
Route::middleware('auth')->post('/configuracoes/usuarios', [App\Http\Controllers\ConfiguracoesController::class, 'novousuario'])->name('novo.usuario');
Route::middleware('auth')->post('/configuracoes/categorias', [App\Http\Controllers\ConfiguracoesController::class, 'novacategoria'])->name('nova.categoria');

Auth::routes();
