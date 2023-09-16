<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Chamado;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Iteracao;
use App\Models\Categoria;
use App\Models\Anexo;
use App\Models\ComentarioPadrao;
use App\Mail\ChamadoAtualizado;
use App\Mail\ChamadosExportacao;

class ChamadosController extends Controller
{
    private function ChamadoAtualizado($destinatarios,$chamado, $novo = false)    
    {
        foreach($destinatarios as $destinatario){
            if($destinatario){
                Mail::to($destinatario)->send(new ChamadoAtualizado($chamado, $novo));
            }
        }
    }

    private function NovaIteracao($chamadoID, $usuarioID, $descricao, $files)
    {
        function Saudacao(){
            $hora_atual = date("H");
    
            $saudacao = "";
    
            if ($hora_atual >= 6 && $hora_atual < 12) {
                $saudacao = "Bom dia";
            } elseif ($hora_atual >= 12 && $hora_atual < 18) {
                $saudacao = "Boa tarde";
            } else {
                $saudacao = "Boa noite";
            }
    
            return $saudacao;
        }

        function Traducao($_texto, $_dicionario) {
            foreach ($_dicionario as $chave => $traducao) {
                $_texto = str_replace($chave, $traducao, $_texto);
            }
            return $_texto;
        }

        $requerente = Chamado::find($chamadoID)->requerente->name;
        $responsavel = User::find($usuarioID)->name;

        $dicionario = array();
        $dicionario['<requerente>']= $requerente;
        $dicionario['<responsavel>']= $responsavel;
        $dicionario['<saudacao>'] = Saudacao();

        $iteracao = new Iteracao;
        $iteracao->descricao = Traducao($descricao, $dicionario);
        $iteracao->datahora = Now();
        $iteracao->usuarioID = $usuarioID;
        $iteracao->chamadoID = $chamadoID;
        $iteracao->save();

        $localAnexo = '/anexos/';

        if ($files) {
            foreach ($files as $file) {

                $nomeFTP = Str::uuid();

                Storage::disk('ftp')->put($localAnexo . $nomeFTP, file_get_contents($file));

                $anexo = new Anexo;
                $anexo->hashftp = $nomeFTP;
                $anexo->nome = $file->getClientOriginalName();
                $anexo->localizacao = 'https://www.castrodev.com.br'.$localAnexo;
                $anexo->iteracaoID = $iteracao->id;
                $anexo->save();
            }
        }
    }

    private function atribuicaoGestor($departamentoID){
        $perfil_gestor = Perfil::where('acesso', 'gestor')->first();
        $gestores = User::where('perfilID', $perfil_gestor->id)->get();
        $menosAtribuicoes = 10000;
        $gestorID = null;
    
       
        foreach($gestores as $gestor){
            if(($gestor->pessoa->disponibilidade) AND ($gestor->pessoa->departamentoID == $departamentoID)){
                if(COUNT($gestor->chamadosGestor->whereNotIn('status',['Resolvido', 'Cancelado'])) < $menosAtribuicoes){
                    $menosAtribuicoes = COUNT($gestor->chamadosGestor->whereNotIn('status',['Resolvido', 'Cancelado']));
                    $gestorID = $gestor->id;              
                }
            }
        }
        return $gestorID;
    }    

    public function lista()
    {
        $userID = auth()->id();

        switch (auth()->user()->perfil->acesso) {
            case 'cliente':
                $chamados = Chamado::where('requerenteID', $userID)->get();
                break;
            case 'tecnico':
                $chamados = Chamado::where('tecnicoID', $userID)->orWhere('requerenteID', $userID)->get();
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
        $comentariospadroes = ComentarioPadrao::where('usuarioID',auth()->id())->get();

        if ($id == 'novo') {
            return view('novo-chamado', compact('categorias', 'prioridades'));
        } else {
            $chamado = Chamado::find($id);
            $perfil_tecnico = Perfil::where('acesso', 'tecnico')->first();
            $tecnicos = User::where('perfilID', $perfil_tecnico->id)->get();  
            $situacoes = ['Aberto', 'Em análise', 'Resolvido', 'Cancelado', 'Aguardando Requerente', 'Aguardando Fornecedor'];
            return view('chamado', compact('chamado', 'categorias', 'prioridades', 'tecnicos', 'situacoes','comentariospadroes'));
        }
    }

    public function alterar(Request $request, $id)
    {
        $chamado = Chamado::find($id);

        if ($request->categoria) {
            $chamado->categoriaID = $request->categoria;
        }

        if ($request->prioridade) {
            $chamado->prioridade = $request->prioridade;
        }

        if ($request->situacao) {
            $chamado->status = $request->situacao;
        }

        if ($request->responsavel) {
            $chamado->tecnicoID = $request->responsavel;
        }

        $chamado->save();

        if ($request->descricao) {
            $this->NovaIteracao($chamado->id, auth()->id(), $request->descricao, $request->file('files'));        
        }

        $destinatarios = [];

        if ($chamado->requerente) {
            $destinatarios[] = $chamado->requerente->email;
        }
        
        if ($chamado->tecnico) {
            $destinatarios[] = $chamado->tecnico->email;
        }
        
        if ($chamado->gestor) {
            $destinatarios[] = $chamado->gestor->email;
        }      

        $this->ChamadoAtualizado($destinatarios, $chamado);        

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

        $departamentoID = Categoria::find($request->input('categoria'))->departamentoID;       
        $chamado->gestorID = $this->atribuicaoGestor($departamentoID);

        $chamado->save();

       
        if ($request->descricao) {
            $this->NovaIteracao($chamado->id, auth()->id(), $request->descricao, $request->file('files'));
        }

        $destinatarios = [];

        if ($chamado->requerente) {
            $destinatarios[] = $chamado->requerente->email;
        }
        
        if ($chamado->tecnico) {
            $destinatarios[] = $chamado->tecnico->email;
        }
        
        if ($chamado->gestor) {
            $destinatarios[] = $chamado->gestor->email;
        }

        $this->ChamadoAtualizado($destinatarios, $chamado, true);  

        return redirect()->route('chamados.lista');
    }

    public function exportacao(Request $request)        
    {
        if($request->selecionados){
            $chamados = Chamado::find($request->selecionados);
            $destinatario = User::find(auth()->id())->email;
            Mail::to($destinatario)->send(new ChamadosExportacao($chamados));
        };
        return redirect()->route('chamados.lista')->with('mensagem', 'Dados selecionados exportados com sucesso!');
    }    

}
