@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.update', $chamado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h4><b>Ticket #{{ $chamado->id }}</b></h4>

        <!-- ============== TOPO ================ -->
        <div class="container-flex">
            <div class="group-flex">
                <label for="titulo">Título</label>
                <input name="titulo" id="titulo" value="{{ $chamado->titulo }}" disabled>
            </div>
            <div class="group-fix">
                <label for="responsavel">Responsável</label>
                @if($perfil=='cliente')
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
                @if($perfil!='gestor')
                <select name="situacao" id="situacao">
                    @foreach ($situacoes as $situacao)
                    <option value="{{ $situacao }}" {{ $chamado->situacao == $situacao ? 'selected' : '' }}>
                        {{ ucfirst($situacao) }}
                    </option>
                    @endforeach
                </select>                                     
                @else
                    <input type="text" disabled name="situacao" id="situacao">
                @endif
            </div>
            <div class="group-fix">            
                <label for="categoria">Categoria</label>
                @if($perfil!='gestor')                
                <select name="categoria" id="categoria">
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ $chamado->categoria == $categoria ? 'selected' : '' }}>
                        {{ $categoria }}
                    </option>
                    @endforeach
                </select>
                @else
                <input name="categoria" id="categoria" value="{{ $chamado->categoria }}" disabled>
                @endif
            </div>
            <div class="group-fix">               
                <label for="prioridade">Prioridade</label>
                @if($perfil=='gestor')
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

        <!-- ============== DESCRIÇÕES ================ -->
        <div class="group-flex" id="lista-descricoes">
            @foreach ($chamado->iteracoes as $iteracao)
            <div>
                <textarea disabled name="" id="" >{{ $iteracao->descricao }}</textarea>
                <div class="two-columns">  
                    <div class="left-col">
                        <p>{{ date('d/m/Y H:i', strtotime($iteracao->datahora )) }} : {{ $iteracao->usuario->name }}</p>            
                    </div>          
                    <div class="right-col">
                        @foreach ($iteracao->anexos as $anexo)
                        <a href= 'https://www.castrodev.com.br{{$anexo->localizacao}}{{$anexo->nome}}' target="_blank">{{$anexo->nome}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- ============== BASE ================ -->
        <div class="container-flex"> 
            @if($perfil!='gestor')
            <a class="btn-img"  title="Novo Comentário" id="ad-comentario" onclick="addComment()"><img src="{{ asset('img/ico-add-com.png') }}"></a>            
            @endif
            @if($perfil=='tecnico')
            <a class="btn-img" title="Comentário Padrão" onclick="alertaPrototipo()"><img src="{{ asset('img/ico-com-padrao.png') }}"></a>
                
            @endif
            @if($perfil!='gestor')
            <label class="btn-img btn-disabled" id="ad-anexo" ><img src="{{ asset('img/ico-attach.png') }}"></label>
            <input onchange="listFiles()" type="file" title="Adicionar Anexo" name="files[]" id="files[]" multiple>
            @endif
            <a class="btn-img"  title="Cancelar Alterações" href="/"><img src="{{ asset('img/ico-cancel.png') }}"></a>               
            <button class="btn-img" type="submit" title="Gravar Alterações"><img src="{{ asset('img/ico-done.png') }}"></button>            
        </div>         
    </form>  
</div>
@endsection