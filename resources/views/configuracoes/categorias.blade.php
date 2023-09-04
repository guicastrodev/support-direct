@extends('layouts.app')
@section('content')

<table>
        <button class="btn-link" onclick="openModal()">
            Nova
        </button>

        <tr style="width:100% !important;">
            <th width=80% style="min-width: 57px;">Título</th>
            <th width=20% style="min-width: 290px;">Departamento</th>
        </tr>
        @foreach($categorias as $categoria)
        <tr class="sel">        
            <td><a href="#" >{{ $categoria->titulo }}</a></td>
            <td><a href="#" >{{ $categoria->departamento }}</a></td>
        </tr>
        @endforeach

</table>
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
                          <option value="{{ $departamento }}">
                              {{ $departamento }}
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
                  <button class="btn-link mb-4" type="submit">Salvar</button>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection    
