<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Chamado;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Iteracao;
use App\Models\Categoria;
use App\Models\Anexo;


class ChamadosController extends Controller
{
    public function NovaIteracao($chamadoID, $usuarioID, $descricao, $files)
    {
        $iteracao = new Iteracao;
        $iteracao->descricao = $descricao;
        $iteracao->datahora = Now();
        $iteracao->usuarioID = $usuarioID;
        $iteracao->chamadoID = $chamadoID;
        $iteracao->save();

        $localAnexo = '/anexos/';

        if (!is_null($files)) {
            foreach ($files as $file) {
                Storage::disk('ftp')->put($localAnexo . $file->getClientOriginalName(), file_get_contents($file));

                $anexo = new Anexo;
                $anexo->nome = $file->getClientOriginalName();
                $anexo->localizacao = $localAnexo;
                $anexo->iteracaoID = $iteracao->id;
                $anexo->save();
            }
        }
    }

    public function lista()
    {
        $userID = auth()->id();

        switch (auth()->user()->perfil->acesso) {
            case 'cliente':
                $chamados = Chamado::where('requerenteID', $userID)->get();
                break;
            case 'tecnico':
                $chamados = Chamado::where('tecnicoID', $userID)->get();
                break;
            case 'gestor':
                $chamados = Chamado::where('gestorID', $userID)->get();
                break;
            default:
                break;
        }

        return view('chamados', compact('chamados'));
    }

    public function visualizar($id)
    {
        $categorias = Categoria::all();
        $prioridades = ['baixa', 'media', 'alta'];
        if ($id == 'novo') {
            return view('novochamado', compact('categorias', 'prioridades'));
        } else {
            $chamado = Chamado::find($id);
            $perfil_tecnico = Perfil::where('acesso', 'tecnico')->first();
            $tecnicos = User::where('perfilID', $perfil_tecnico->id)->get();  
            $situacoes = ['Aberto', 'Em análise', 'Resolvido', 'Cancelado', 'Aguardando Requerente', 'Aguardando Fornecedor'];
            return view('chamado', compact('chamado', 'categorias', 'prioridades', 'tecnicos', 'situacoes'));
        }
    }

    public function alterar(Request $request, $id)
    {
        $chamado = Chamado::find($id);

        if (!is_null($request->categoria)) {
            $chamado->categoriaID = $request->categoria;
        }

        if (!is_null($request->prioridade)) {
            $chamado->prioridade = $request->prioridade;
        }

        if (!is_null($request->situacao)) {
            $chamado->status = $request->situacao;
        }

        if (!is_null($request->responsavel)) {
            $chamado->tecnicoID = $request->responsavel;
        }

        $chamado->save();

        if (!is_null($request->descricao)) {
            $this->NovaIteracao($chamado->id, auth()->id(), $request->descricao, $request->file('files'));        
        }


        return redirect()->route('chamado.visualizar', $chamado->id)->with('mensagem', 'Chamado atualizado com sucesso!');
    }

    public function novo(Request $request)
    {
        $chamado = new Chamado;
        $chamado->requerenteID = auth()->id();
        $chamado->titulo = $request->input('titulo');
        $chamado->categoriaID = $request->input('categoria');
        $chamado->prioridade = $request->input('prioridade');
        $chamado->status = 'Aberto';

        $perfil_gestor = Perfil::where('acesso', 'gestor')->first();
        $gestor = User::where('perfilID', $perfil_gestor->id)->first();        

        $chamado->gestorID = $gestor->id;

        $chamado->save();

       
        if (!is_null($request->descricao)) {
            $this->NovaIteracao($chamado->id, auth()->id(), $request->descricao, $request->file('files'));
        }

        return redirect()->route('chamados.lista');
    }
}
