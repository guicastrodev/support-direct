<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {return redirect('login');});

Route::middleware('auth')->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->get('/chamados', [App\Http\Controllers\ChamadosController::class, 'lista'])->name('chamados.lista');
Route::middleware('auth')->post('/chamados/exportacao', [App\Http\Controllers\ChamadosController::class, 'exportacao'])->name('chamados.exportar');
Route::middleware('auth')->get('/chamado/{id}',[App\Http\Controllers\ChamadosController::class, 'visualizar'])->name('chamado.visualizar');
Route::middleware('auth')->put('/chamado/{id}', [App\Http\Controllers\ChamadosController::class, 'alterar'])->name('chamado.alterar');
Route::middleware('auth')->post('/chamado', [App\Http\Controllers\ChamadosController::class, 'novo'])->name('chamado.novo');
Route::middleware('auth')->get('/configuracoes/usuarios', [App\Http\Controllers\ConfiguracoesController::class, 'usuarios'])->name('configuracoes.usuarios');
Route::middleware('auth')->post('/configuracoes/usuario-novo', [App\Http\Controllers\ConfiguracoesController::class, 'novousuario'])->name('novo.usuario');
Route::middleware('auth')->get('/configuracoes/usuario/{id}', [App\Http\Controllers\ConfiguracoesController::class, 'usuario'])->name('configuracoes.usuario');
Route::middleware('auth')->post('/configuracoes/usuario/{id}', [App\Http\Controllers\ConfiguracoesController::class, 'alterarusuario'])->name('configuracoes.usuarioalterar');
Route::middleware('auth')->get('/configuracoes/categorias', [App\Http\Controllers\ConfiguracoesController::class, 'categorias'])->name('configuracoes.categorias');
Route::middleware('auth')->post('/configuracoes/categorias', [App\Http\Controllers\ConfiguracoesController::class, 'novacategoria'])->name('nova.categoria');
Route::middleware('auth')->get('/configuracoes/comentariospadroes', [App\Http\Controllers\ConfiguracoesController::class, 'comentariospadroes'])->name('configuracoes.comentariospadroes');
Route::middleware('auth')->post('/configuracoes/comentariospadroes', [App\Http\Controllers\ConfiguracoesController::class, 'novocomentariopadrao'])->name('novo.comentariopadrao');
Route::middleware('auth')->delete('/configuracoes/comentariopadrao/{id}', [App\Http\Controllers\ConfiguracoesController::class, 'removercomentariopadrao'])->name('configuracoes.comentariopadrao-remover');