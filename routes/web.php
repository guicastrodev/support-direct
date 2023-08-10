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

Route::get('/', function () {
    /*return view('welcome');*/
    return redirect('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chamados/{id}',[App\Http\Controllers\ChamadoController::class, 'show'])->name('chamado.show');
Route::get('/chamados/new',[App\Http\Controllers\ChamadoController::class, 'new'])->name('chamado.new');
Route::put('/chamados/{id}', [App\Http\Controllers\ChamadoController::class, 'update'])->name('chamado.update');

Auth::routes();
