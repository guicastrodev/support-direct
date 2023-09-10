@extends('layouts.app')
@section('content')
<div class="painel">
    <div class="container-flex title">
        <div class="group-title">
                <button onclick="openModal()" title="Novo Comentário Padrão"><img src="{{ asset('img/ico-add-com-padrao.png') }}"></button>            
                <a>Comentários Padrões</a>                
        </div>
    </div>
    <table>
        @foreach($comentariospadroes as $comentariopadrao)
        <tr class="sel">        
            <td style="width:100vw; min-width: 200px;"><a href="#" >{{ $comentariopadrao->mensagem }}</a></td>
        </tr>
        @endforeach
    </table>
</div>
<div class="modal" id="modal">
    <div class="modal-content">
        <form method="POST" action="{{ route('novo.comentariopadrao') }}">
            @csrf
            <div class="painel">
                <div>
                  <h3><b> Novo Comentário Padrão </b></h3>
                  <hr>
                </div>
                <div class="container-flex"> 
                    <div class="group-flex-m">           
                        <label for="comentario">Comentário Padrão:</label>
                        <input type="text" name="comentario" id="comentario" required>
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
