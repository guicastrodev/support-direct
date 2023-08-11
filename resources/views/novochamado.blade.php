@extends('layouts.app')

@section('content')

<div class="painel">
        <input type="text" placeholder="Título"></input>        
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria">
            @foreach ($categorias as $categoria)
            <option type="submit" onclick="alertaPrototipo()">
                {{ $categoria }}
            </option>
            @endforeach
        </select>

        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" id="prioridade">
            @foreach ($prioridades as $prioridade)
            <option value="{{ $prioridade }}">
                {{ ucfirst($prioridade) }}
            </option>
            @endforeach
        </select>

        <div class="chamado-descricoes">
            <textarea placeholder="Descrição" disabled name="" id="" style="width:100%"></textarea>
        </div>
        <button type="button" onclick="alertaPrototipo()">Anexos</button>
        <button type="submit" onclick="alertaPrototipo()">Confirmar</button>
        <button type="submit" onclick="location.href='/home'">Cancelar</button>       
</div>
@endsection