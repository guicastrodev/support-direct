<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfiguracoesController extends Controller
{
    public function usuarios(){
        $usuarios = User::all();
        $perfis=['gerente','tecnico','cliente'];
        return view('configuracoes.usuarios',compact('usuarios','perfis'));
    }

    public function categorias(){
        $categorias = Categoria::all();

        $departamentos = ['TI','RH','Financeiro'];

        $categorias = Categoria::all();
        return view('configuracoes.categorias',compact('categorias','departamentos'));
    }

    public function novousuario(Request $request){

        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);        
        $usuario->tipo = $request->tipo;
        $usuario->save();

        $usuarios = User::all();
        $perfis=['gerente','tecnico','cliente'];
        return view('configuracoes.usuarios',compact('usuarios','perfis'));
    }

    public function novacategoria(Request $request){

        $categoria = new Categoria;
        $categoria->titulo = $request->titulo;
        $categoria->descricao = $request->descricao;
        $categoria->departamento = $request->departamento;
        $categoria->save();

        $departamentos = ['TI','RH','Financeiro'];

        $categorias = Categoria::all();
        return view('configuracoes.categorias',compact('categorias','departamentos'));
    }    

}
