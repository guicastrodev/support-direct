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

Auth::routes();
