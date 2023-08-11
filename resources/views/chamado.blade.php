@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.update', $chamado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h4><b>Ticket #{{ $chamado->id }}</b></h4>
        <label>{{ $chamado->titulo }}</label>
        <label for="categoria">Categoria:</label>
        @if($perfil!='gestor')
            <select name="categoria" id="categoria">
        @else
            <select disabled name="categoria" id="categoria">
        @endif
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria }}" {{ $chamado->categoria == $categoria ? 'selected' : '' }}>
                {{ $categoria }}
            </option>
            @endforeach
        </select>
        
        <label for="prioridade">Prioridade:</label>
        @if($perfil!='gestor')
            <select disabled name="prioridade" id="prioridade">
        @else
            <select name="prioridade" id="prioridade">
        @endif            
            @foreach ($prioridades as $prioridade)
            <option value="{{ $prioridade }}" {{ $chamado->prioridade == $prioridade ? 'selected' : '' }}>
                {{ ucfirst($prioridade) }}
            </option>
            @endforeach
        </select>

        <div class="chamado-descricoes">
            @foreach ($chamado->iteracoes as $iteracao)
            <textarea disabled name="" id="" style="width:100%">{{ $iteracao->descricao }}</textarea>
            <p>{{ date('d/m/Y H:i', strtotime($iteracao->datahora )) }} : {{ $iteracao->usuario->name }}</p>
            @endforeach
        </div>
        @if($perfil!='gestor')
            <button type="button" onclick="alertaPrototipo()">+ Comentário</button>
        @endif
        @if($perfil=='tecnico')
            <button type="button" onclick="alertaPrototipo()">+ Comentário Padrão</button>
        @endif

        @if($perfil!='gestor')
            <button type="button" onclick="alertaPrototipo()">Anexos</button>
        @endif
        

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

        @if($perfil=='gestor')
            <select disabled name="situacao" id="situacao">
        @else
            <select name="situacao" id="situacao">
        @endif            

            @foreach ($situacoes as $situacao)
            <option value="{{ $situacao }}" {{ $chamado->situacao == $situacao ? 'selected' : '' }}>
                {{ ucfirst($situacao) }}
            </option>
            @endforeach
        </select>

        <button type="submit">Cancelar</button>               
        <button type="submit" onclick="alertaPrototipo()">Confirmar</button>        
        
    </form>
    
</div>
@endsection