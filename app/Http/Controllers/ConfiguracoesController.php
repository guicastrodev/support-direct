<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Categoria;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfiguracoesController extends Controller
{
    public function usuarios(){
        $usuarios = User::all();
        $perfis= Perfil::all()->whereNotIn('acesso',['adm']);
        return view('configuracoes.usuarios',compact('usuarios','perfis'));
    }

    public function categorias(){
        $categorias = Categoria::all();
        $departamentos = Departamento::all();

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
        $perfis= Perfil::all()->whereNotIn('acesso',['adm']);
        return view('configuracoes.usuarios',compact('usuarios','perfis'));
    }

    public function novacategoria(Request $request){

        $categoria = new Categoria;
        $categoria->titulo = $request->titulo;
        $categoria->descricao = $request->descricao;
        $categoria->departamento = $request->departamento;
        $categoria->save();

        $departamentos = Departamento::all();
        $categorias = Categoria::all();

        return view('configuracoes.categorias',compact('categorias','departamentos'));
    }    

}
