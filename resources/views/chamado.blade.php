@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.alterar', $chamado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h4><b>Ticket #{{ $chamado->id }}</b></h4>
        <div class="container-flex">
            <div class="group-flex">
                <label for="titulo">Título</label>
                <input name="titulo" id="titulo" value="{{ $chamado->titulo }}" disabled>
            </div>
            <div class="group-fix">
                <label for="responsavel">Responsável</label>
                @if($perfil->acesso=='cliente')
                    @if(isset($chamado->tecnico))
                        <input type="text" disabled name="responsavel" id="responsavel" value="{{$chamado->tecnico->name}}">
                    @else
                        <input type="text" disabled name="responsavel" id="responsavel">
                    @endif
                @else
                <select name="responsavel" id="responsavel">
                    @foreach ($tecnicos as $tecnico)
                        <option value="{{ $tecnico->id }}" {{ $chamado->tecnicoID == $tecnico->id ? 'selected' : '' }}>
                            {{ $tecnico->name }}
                        </option>
                    @endforeach
                </select>
                @endif        
            </div>
            <div class="group-fix">
                <label for="situacao">Situação</label>
                @if($perfil->acesso!='gestor')
                    <select name="situacao" id="situacao">
                        @foreach ($situacoes as $situacao)
                            <option value="{{ $situacao }}" {{ $chamado->status == $situacao ? 'selected' : '' }}>
                                {{ ucfirst($situacao) }}
                            </option>
                        @endforeach
                    </select>                                     
                @else
                    <input name="situacao" id="situacao" value="{{ $chamado->status }}" disabled>
                @endif
            </div>
            <div class="group-fix">            
                <label for="categoria">Categoria</label>
                @if($perfil->acesso!='gestor')                
                    <select name="categoria" id="categoria">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $chamado->categoriaID == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input name="categoria" id="categoria" value="{{ $chamado->categoria->nome }}" disabled>
                @endif
            </div>
            <div class="group-fix">               
                <label for="prioridade">Prioridade</label>
                @if($perfil->acesso=='gestor')
                    <select name="prioridade" id="prioridade">
                        @foreach ($prioridades as $prioridade)
                            <option value="{{ $chamado->$prioridade }}" {{ $chamado->prioridade == $prioridade ? 'selected' : '' }}>
                                {{ ucfirst($prioridade) }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input name="prioridade" id="prioridade" value="{{ $chamado->prioridade }}" disabled>
                @endif                
            </div>
        </div>

        <div class="group-flex" id="lista-descricoes">
            @foreach ($chamado->iteracoes as $iteracao)
            <div>
                <textarea disabled name="" id="" >{{ $iteracao->descricao }}</textarea>
                <div>
                    <p>{{ date('d/m/Y H:i', strtotime($iteracao->datahora )) }} : {{ $iteracao->usuario->name }} - Anexos [
                    @foreach ($iteracao->anexos as $anexo)
                        <a href= '{{$anexo->localizacao}}{{$anexo->hashftp}}' target="_blank">{{$anexo->nome}}</a><a>; </a>
                    @endforeach
                    ]
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="container-flex"> 
            @if($perfil->acesso!='gestor')
                <a class="btn-img" title="Novo Comentário" id="ad-comentario" onclick="addComment()"><img src="{{ asset('img/ico-add-com.png') }}"></a>            
            @endif
            @if($perfil->acesso=='tecnico')
                <a class="btn-img" title="Comentário Padrão" id="ad-com-padrao" onclick="openModal()"><img src="{{ asset('img/ico-com-padrao.png') }}"></a>            
            @endif
            @if($perfil->acesso!='gestor')
                <label class="btn-img btn-disabled" id="ad-anexo" ><img src="{{ asset('img/ico-attach.png') }}"></label>
                <input onchange="listFiles()" type="file" title="Adicionar Anexo" name="files[]" id="files[]" multiple>
            @endif
                <a class="btn-img"  title="Cancelar Alterações" href="/"><img src="{{ asset('img/ico-cancel.png') }}"></a>               
                <button class="btn-img" type="submit" title="Gravar Alterações"><img src="{{ asset('img/ico-done.png') }}"></button>            
        </div>         
    </form>  
</div>
<div class="modal" id="modal">
    <div class="modal-content">
        <div class="painel">  
            <div class="container-flex title">
                <div class="group-title">
                    <a>Comentários Padrões</a>                
                </div>
            </div>                    
            <table>
                <tbody style="min-height: 150px;">
                @foreach($comentariospadroes as $comentariopadrao)
                    <tr class="sel">        
                        <td style="width:50vw; min-width: 200px;"><a onclick="addMsgPadrao('{{$comentariopadrao->mensagem}}')">{{ $comentariopadrao->mensagem }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection