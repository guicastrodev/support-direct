<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\User;

class TicketsController extends Controller
{
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

        $request->validate([
            'categoria' => 'required',
            'prioridade' => 'required',
            'responsavel' => 'required',
            'situacao' => 'required',
        ]);

        $chamado->categoria = $request->categoria;
        $chamado->prioridade = $request->prioridade;
        $chamado->responsavelID = $request->responsavel;
        $chamado->situacao = $request->situacao;

        $chamado->save();

        return redirect()->route('chamado.show', $chamado->id)->with('success', 'Chamado atualizado com sucesso.');
    }
}
