@extends('layouts.app')

@section('content')
    <div class="painel">
        <h4><b># Novo Chamado</b></h4>
        <form action="{{ route('chamado.novo') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container-flex">
                <div class="group-flex">
                        <label for="titulo">Título</label>
                        <input  title="Título do Chamado (preenchimento obrigatório)" name="titulo" id="titulo" required>
                    </div>
                    <div class="group-fix">            
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria">
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nome }}
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
                    <textarea title="Descrição do Chamado (preenchimento obrigatório)" class='autosize' name="descricao" id="descricao" required></textarea>
                </div>
                <div class="container-flex">
                    <label class="btn-img" for="files[]"><img src="{{ asset('img/ico-attach.png') }}"></label>
                    <input onchange="listFiles()" type="file" title="Adicionar Anexo" name="files[]" id="files[]" multiple>
                    <a class="btn-img"  title="Cancelar Alterações/Fechar" href="/chamados"><img src="{{ asset('img/ico-cancel.png') }}"></a>
                    <button class="btn-img" type="submit" title="Gravar Alterações"><img src="{{ asset('img/ico-done.png') }}"></button>
                </div>
            </div>
        </form>
    </div>
@endsection