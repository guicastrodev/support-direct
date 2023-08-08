<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = Chamado::all();
        return view('chamados.index', compact('chamados'));
    }
}
