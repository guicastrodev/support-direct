<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ConfiguracoesController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('configuracoes.index',compact('usuarios'));
    }
}
