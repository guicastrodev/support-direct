<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userID = auth()->id();  
        $perfil = auth()->user()->tipo;  

        switch ($perfil) {
            case 'cliente':
                $chamados = Chamado::where('requerenteID', $userID )->get();
                break;
            case 'tecnico':
                $chamados = Chamado::where('tecnicoID', $userID )->get();
                break;
            case 'gestor':
                $chamados = Chamado::where('gestorID', $userID )->get();
                break;
            default:
                // O tipo do usuário é uma informação obrigatória!
                break;
        } 
        
        return view('home', compact('chamados','perfil'));
    }

}
