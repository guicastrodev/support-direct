@extends('layouts.app')

@section('content')
<div class="painel">
    <form action="{{ route('chamado.update', $chamado->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h5>{{ $chamado->titulo }}</h5>
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
            <p>Responsável: {{ $iteracao->usuario->nome }}</p>
            @endforeach
        </div>

        <button type="button">+ Comentário</button>
        <button type="button">+ Comentário Padrão</button>
        <button type="button">Anexos</button>

        <select name="responsavel" id="responsavel">
            @foreach ($responsaveis as $responsavel)
            <option value="{{ $responsavel->id }}" {{ $chamado->responsavel_id == $responsavel->id ? 'selected' : '' }}>
                {{ $responsavel->nome }}
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

        <button type="submit">Confirmar</button>
        <a href="{{route('chamado.show',$chamado->id)}}">Cancelar</a>
    </form>
</div>
@endsection