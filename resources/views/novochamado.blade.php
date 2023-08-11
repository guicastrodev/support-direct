@extends('layouts.app')

@section('content')

<div class="painel">
<h4><b># Novo Ticket</b></h4>

<div class="ticket-details">
    <div class="form-group-70">
        <label for="titulo">Título</label>
        <input name="titulo" id="titulo" placeholder="Título">
    </div>
    <div class="form-group-15">            
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            @foreach ($categorias as $categoria)
            <option>
                {{ $categoria }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group-15">               
        <label for="prioridade">Prioridade</label>
        <select name="prioridade" id="prioridade">
            @foreach ($prioridades as $prioridade)
            <option>
                {{ ucfirst($prioridade) }}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="chamado-descricoes">
    <textarea placeholder="Descrição" name="" id="" style="width:99%"></textarea>
</div>
<button type="button" onclick="alertaPrototipo()">Anexos</button>
<button type="submit" onclick="alertaPrototipo()">Confirmar</button>
<button type="submit" onclick="location.href='/tickets'">Cancelar</button>       
</div>
@endsection