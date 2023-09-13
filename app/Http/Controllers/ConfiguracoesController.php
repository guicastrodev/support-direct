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
        $departamentos = Departamento::all();        
        return view('configuracoes.usuarios',compact('usuarios','perfis','departamentos'));
    }

    public function usuario($id){
        $usuario = User::find($id);
        $perfis= Perfil::all()->whereNotIn('acesso',['adm']);
        $departamentos = Departamento::all();        
        return view('configuracoes.usuario',compact('usuario','perfis','departamentos'));
    }

    public function alterarusuario(Request $request, $id){
        $usuario = User::find($id);


        $request->session()->forget(['mensagem', 'erro']);
        if(count(User::where('email',$request->email)->whereNotIn('id',[$usuario->id])->get())>0){
            Session::flash('erro', 'Dados do usuário não alterados! Já existe um cadastro com o email informado!');
        }else{
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->senha);
            $usuario->perfilID = $request->perfil;

            $usuario->save();

            $pessoa = Pessoa::find($usuario->pessoaID);
            $pessoa->departamentoID = $request->departamento;
            if($request->ativo){        
                $pessoa->disponibilidade = true;
            }
            else{
                $pessoa->disponibilidade = false;
            }

            $pessoa->save(); 

            Session::flash('mensagem', 'Dados do usuário alterados com sucesso!' );
        }

        return redirect()->route('configuracoes.usuarios');
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
            $pessoa->nome = $request->nome;
            if($request->departamento){
                $pessoa->departamentoID = $request->departamento;            
            }
            $pessoa->save();        
            //

            $usuario = new User;
            $usuario->name = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->senha);        
            $usuario->perfilID = $request->perfil;
            $usuario->pessoaID = $pessoa->id;        
            $usuario->save();

            Session::flash('mensagem', 'Usuário incluído com sucesso!' );
        }

        $usuarios = User::all();
        $perfis = Perfil::all()->whereNotIn('acesso',['adm']);
        $departamentos = Departamento::all();        

        return view('configuracoes.usuarios',compact('usuarios','perfis','departamentos'));
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

    public function removercomentariopadrao($id){
        $comentariopadrao = ComentarioPadrao::find($id);
        $comentariopadrao->delete();

        return redirect()->back()->with('mensagem', 'Comentário Padrão removido com sucesso!' );
    }    
}
