@extends('layouts.app')

@section('content')

<div class="painel">
<h4><b># Novo Ticket</b></h4>
<form action="{{ route('ticket.new') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container-flex">
        <div class="group-flex">
                <label for="titulo">Título</label>
                <input name="titulo" id="titulo">
            </div>
            <div class="group-fix">            
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria">
                    @foreach ($categorias as $categoria)
                    <option>
                        {{ $categoria }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="group-fix">               
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
        <div class="group-flex" id="grupo-descricao">
            <label for="descricao">Descrição</label>
            <textarea class='autosize' name="descricao" id="descricao" ></textarea>
        </div>
        <div class="container-flex">
            <label class="btn-img" for="files[]"><img src="{{ asset('img/ico-attach.png') }}"></label>
            <input onchange="listFiles()" type="file" title="Adicionar Anexo" name="files[]" id="files[]" multiple>
            <a class="btn-img"  title="Cancelar Alterações" href="/tickets"><img src="{{ asset('img/ico-cancel.png') }}"></a>
            <button class="btn-img" type="submit" title="Gravar Alterações"><img src="{{ asset('img/ico-done.png') }}"></button>
        </div>
    </div>
</form>

@endsection