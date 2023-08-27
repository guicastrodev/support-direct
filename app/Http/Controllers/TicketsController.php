<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Chamado;
use App\Models\User;
use App\Models\Iteracao;
use App\Models\Anexo;


class TicketsController extends Controller
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

    public function index()
    {
        $userID = auth()->id();
        $perfil = auth()->user()->tipo;

        switch ($perfil) {
            case 'cliente':
                $tickets = Chamado::where('requerenteID', $userID)->get();
                break;
            case 'tecnico':
                $tickets = Chamado::where('tecnicoID', $userID)->get();
                break;
            case 'gestor':
                $tickets = Chamado::where('gestorID', $userID)->get();
                break;
            default:
                // O tipo do usuário é uma informação obrigatória!
                break;
        }

        return view('tickets', compact('tickets', 'perfil'));
    }

    public function show($id)
    {
        $categorias = ['Acesso', 'Conexão', 'E-mail', 'Hardware', 'Impressão', 'Materiais', 'Rede', 'Segurança', 'Servidor', 'Sistema', 'Software'];
        $prioridades = ['baixa', 'media', 'alta'];
        $perfil = auth()->user()->tipo;
        if ($id == 'novo') {
            return view('novochamado', compact('categorias', 'prioridades'));
        } else {
            $chamado = Chamado::findOrFail($id);
            $tecnicos = User::where('tipo', 'tecnico')->get();
            $situacoes = ['Aberto', 'Em análise', 'Resolvido', 'Cancelado', 'Aguardando Requerente', 'Aguardando Fornecedor'];
            return view('chamado', compact('chamado', 'categorias', 'prioridades', 'tecnicos', 'situacoes', 'perfil'));
        }
    }

    public function update(Request $request, $id)
    {
        $chamado = Chamado::findOrFail($id);

        /*
        $request->validate([
            'categoria' => 'required',
            'prioridade' => 'required',
            'responsavel' => 'required',
            'situacao' => 'required',
        ]);
        */

        if (!is_null($request->categoria)) {
            $chamado->categoria = $request->categoria;
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

        return redirect()->route('chamado.show', $chamado->id)->with('success', 'Chamado atualizado com sucesso.');
    }

    public function new(Request $request)
    {
        $chamado = new Chamado;
        $chamado->requerenteID = auth()->id();
        $chamado->titulo = $request->input('titulo');
        $chamado->categoria = $request->input('categoria');
        $chamado->prioridade = $request->input('prioridade');
        $chamado->status = 'Aberto';

        $gestor = User::where('tipo', 'gestor')->first();

        $chamado->gestorID = $gestor->id;
        $chamado->save();

        
        if (!is_null($request->descricao)) {
            $this->NovaIteracao($chamado->id, auth()->id(), $request->descricao, $request->file('files'));        
        }

        return redirect()->route('tickets');
    }
}
