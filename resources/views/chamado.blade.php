@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.update', $chamado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h4><b>Ticket #{{ $chamado->id }}</b></h4>

        <!-- ============== TOPO ================ -->
        <div class="ticket-details">
            <div class="form-group-70">
                <label for="titulo">Título</label>
                <input name="titulo" id="titulo" value="{{ $chamado->titulo }}" disabled>
            </div>
            <div class="form-group-15">            
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
            <div class="form-group-15">               
                <label for="prioridade">Prioridade</label>
                @if($perfil=='gestor')
                <select name="prioridade" id="prioridade">
                    @foreach ($prioridades as $prioridade)
                    <option value="{{ $prioridade }}" {{ $chamado->prioridade == $prioridade ? 'selected' : '' }}>
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
        <div class="chamado-descricoes">
            @foreach ($chamado->iteracoes as $iteracao)
            <textarea disabled name="" id="" style="width:100%">{{ $iteracao->descricao }}</textarea>
            <p>{{ date('d/m/Y H:i', strtotime($iteracao->datahora )) }} : {{ $iteracao->usuario->name }}</p>
            @endforeach
        </div>




        
    </form>
        <!-- ============== BASE ================ -->
        <div class="ticket-details"> 
            <div class="form-group-50">
                    <div class="form-group-30">
                        @if($perfil!='gestor')
                            <button type="button" onclick="alertaPrototipo()">+ Comentário</button>
                        @endif
                    </div>
                    <div class="form-group-30">
                        @if($perfil=='tecnico')
                            <button type="button" onclick="alertaPrototipo()">+ Comentário Padrão</button>
                        @endif
                    </div>
                    <div class="form-group-30">
                        @if($perfil!='gestor')
                            <button type="button" onclick="alertaPrototipo()">Anexos</button>
                        @endif
                    </div>
            </div>
            <div class="form-group-50">
                    <div class="form-group-30">
                        <button type="submit"> <a href="/">Cancelar</a></button>               
                    </div>
                    <div class="form-group-30">
                        <button type="submit" onclick="alertaPrototipo()">Confirmar</button>            
                    </div>                    
                    <div class="form-group-30">
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
                    <div class="form-group-30">
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
            </div>
        </div>    
</div>
@endsection