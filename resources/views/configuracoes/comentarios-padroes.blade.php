@extends('layouts.app')
@section('content')
<div class="painel">
    <div class="container-flex title">
        <div class="group-title">
                <button class="btn-left" onclick="openModal()" title="Novo Comentário Padrão"><img src="{{ asset('img/ico-add-com-padrao.png') }}"> Novo</button>            
                <a class="title-a-center">Comentários Padrões</a>                
        </div>
    </div>
    <table>        
        <form method="POST" id='form-exclusao'>
            @foreach($comentariospadroes as $comentariopadrao)
                <tr class="sel">        
                <td style="width:93vw; min-width: 200px;"><a href="#" >{{ $comentariopadrao->mensagem }}</a></td>
                    @csrf      
                    @method('DELETE')                        
                    <td style="width:52w; min-width: 20px;"><button type="button" onclick="abreConfirmacaoExclusao('{{ route('configuracoes.comentariopadrao-remover', ['id' => $comentariopadrao->id]) }}')" class="btn-reg" title="Remover Registro"><img src="{{ asset('img/ico-delete-reg.png') }}"></button></td>        
                </tr>
            @endforeach
        </form>        
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
                        <textarea style="width: 100%;" title="Descrição do Comentário Padrão (preenchimento obrigatório)" name="comentario" id="comentario" required></textarea>                        
                    </div>
                </div>    
                <div class="container-flex"> 
                    <a class="btn-img" onclick="closeModal()" title="Cancelar Inclusão/Fechar"><img src="{{ asset('img/ico-cancel.png') }}"></a>                        
                    <button class="btn-img" type="submit" title="Gravar Inclusão"><img src="{{ asset('img/ico-done.png') }}"></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection    
