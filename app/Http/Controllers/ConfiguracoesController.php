<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pessoa;
use App\Models\Perfil;
use App\Models\Categoria;
use App\Models\ComentarioPadrao;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function comentariospadroes(){
        $comentariospadroes = ComentarioPadrao::all();

        return view('configuracoes.comentarios-padroes',compact('comentariospadroes'));
    }

    public function novousuario(Request $request){
        $request->session()->forget(['mensagem', 'erro']);

        if(count(User::where('email',$request->email)->get())>0){
            Session::flash('erro', 'Usuário não incluído! Já existe um cadastro com o email informado!');
        }else{
            // TO DO: Incluir lista de seleção de pessoa, e cadastro para inclusão de pessoa

            // Implementação provisória, apenas para atender requisito de dependencia
            $pessoa = new Pessoa;
            $pessoa->nome = $request->name;
            $pessoa->save();        
            //

            $usuario = new User;
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);        
            $usuario->perfilID = $request->perfil;
            $usuario->pessoaID = $pessoa->id;        
            $usuario->save();

            Session::flash('mensagem', 'Usuário incluído com sucesso!' );
        }

        $usuarios = User::all();
        $perfis = Perfil::all()->whereNotIn('acesso',['adm']);

        return view('configuracoes.usuarios',compact('usuarios','perfis'));
    }

    public function novacategoria(Request $request){

        $categoria = new Categoria;
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $categoria->departamentoID = $request->departamento;
        $categoria->save();

        $departamentos = Departamento::all();
        $categorias = Categoria::all();

        Session::flash('mensagem', 'Categoria incluída com sucesso!' );

        return view('configuracoes.categorias',compact('categorias','departamentos'));
    } 
    
    public function novocomentariopadrao(Request $request){
        $comentariospadroes = new ComentarioPadrao;
        $comentariospadroes->mensagem = $request->comentario;
        $comentariospadroes->usuarioID = auth()->id();
        $comentariospadroes->save();

        $comentariospadroes = ComentarioPadrao::all();        

        Session::flash('mensagem', 'Comentário Padrão incluído com sucesso!' );

        return view('configuracoes.comentarios-padroes',compact('comentariospadroes'));        
    }
}
