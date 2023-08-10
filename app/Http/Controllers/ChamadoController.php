<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\User;

class ChamadoController extends Controller
{
    public function show($id)
    {

        $chamado = Chamado::findOrFail($id);
        $categorias = ['Rede','Software','Materiais','Hardware','Segurança'];
        $prioridades = ['baixa', 'media', 'alta'];
        $responsaveis = User::where('tipo', 'tecnico')->get();
        $situacoes = ['aberto', 'em andamento', 'fechado'];   

        return view('chamado', compact('chamado', 'categorias', 'prioridades', 'responsaveis', 'situacoes'));
    }

    public function new()
    {
        //return view('chamado', compact('chamado', 'categorias', 'prioridades', 'responsaveis', 'situacoes'));
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

        return redirect()->route('chamados.show', $chamado->id)->with('success', 'Chamado atualizado com sucesso.');
    } 
}
