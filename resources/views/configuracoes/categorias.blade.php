@extends('layouts.app')
@section('content')
<div class="painel">
    <div class="container-flex title">
        <div class="group-title">
                <button onclick="openModal()" title="Nova Categoria"><img src="{{ asset('img/ico-add-category.png') }}"></button>            
                <a>Categorias</a>                
        </div>
    </div>
    <table>
        <tr>
            <th style="width:50vw; min-width: 200px;">Título</th>
            <th style="width:50vw; min-width: 200px;">Departamento</th>
        </tr>
        @foreach($categorias as $categoria)
        <tr class="sel">        
            <td><a href="#" >{{ $categoria->nome }}</a></td>
            <td><a href="#" >{{ $categoria->departamento->nome }}</a></td>
        </tr>
        @endforeach
    </table>
</div>
<div class="modal" id="modal">
    <div class="modal-content">
        <form method="POST" action="{{ route('nova.categoria') }}">
            @csrf
            <div class="painel">
                <div>
                  <h3><b> Nova Categoria </b></h3>
                  <hr>
                </div>
                <div class="container-flex"> 
                    <div class="group-flex-m">           
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" id="titulo" >
                    </div>
                    <div class="group-fix mb-4">
                        <label for="departamento">Departamento:</label>
                        <select name="departamento" id="departamento" >
                          @foreach ($departamentos as $departamento)
                          <option value="{{ $departamento->id }}">
                              {{ $departamento->nome }}
                          </option>
                          @endforeach
                        </select>
                    </div>
                </div>    
                <div class="container-flex">                     
                    <div class="group-flex-m">
                        <label for="descricao">Descrição:</label>
                        <input type="text" name="descricao" id="descricao" >
                    </div>
                </div>
                <div class="container-flex"> 
                    <a class="btn-img" onclick="closeModal()" title="Cancelar Inclusão"><img src="{{ asset('img/ico-cancel.png') }}"></a>                        
                    <button class="btn-img" type="submit" title="Gravar Inclusão"><img src="{{ asset('img/ico-done.png') }}"></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection    
