@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.update', $chamado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h4><b>#{{ $chamado->id }}</b></h4>
        <label>{{ $chamado->titulo }}</label>
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria">
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria }}" {{ $chamado->categoria == $categoria ? 'selected' : '' }}>
                {{ $categoria }}
            </option>
            @endforeach
        </select>

        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" id="prioridade">
            @foreach ($prioridades as $prioridade)
            <option value="{{ $prioridade }}" {{ $chamado->prioridade == $prioridade ? 'selected' : '' }}>
                {{ ucfirst($prioridade) }}
            </option>
            @endforeach
        </select>

        <div class="chamado-descricoes">
            @foreach ($chamado->iteracoes as $iteracao)
            <textarea disabled name="" id="" style="width:100%">{{ $iteracao->descricao }}</textarea>
            <p>{{ date('d/m/Y H:i', strtotime($iteracao->datahora )) }} : {{ $iteracao->usuario->nome }}</p>
            @endforeach
        </div>

        <button type="button" onclick="alertaPrototipo()">+ Comentário</button>
        <button type="button" onclick="alertaPrototipo()">+ Comentário Padrão</button>
        <button type="button" onclick="alertaPrototipo()">Anexos</button>

        <select name="responsavel" id="responsavel">
            @foreach ($tecnicos as $tecnico)
            <option value="{{ $tecnico->id }}" {{ $chamado->responsavelID == $tecnico->id ? 'selected' : '' }}>
                {{ $tecnico->nome }}
            </option>
            @endforeach
        </select>

        <select name="situacao" id="situacao">
            @foreach ($situacoes as $situacao)
            <option value="{{ $situacao }}" {{ $chamado->situacao == $situacao ? 'selected' : '' }}>
                {{ ucfirst($situacao) }}
            </option>
            @endforeach
        </select>

        <button type="submit" onclick="alertaPrototipo()">Confirmar</button>
        <button>Cancelar<a class="none" href="{{route('chamado.show',$chamado->id)}}"></a></button>    
    </form>
    
</div>
@endsection