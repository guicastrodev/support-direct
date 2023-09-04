@extends('layouts.app')
@section('content')

<table>
        <!-- Botão "Novo" -->
        <button class="btn-link" onclick="openModal()">
            Novo
        </button>

        <tr style="width:100% !important;">
            <th width=80% style="min-width: 57px;">Nome</th>
            <th width=20% style="min-width: 290px;">Perfil</th>
        </tr>
        @foreach($usuarios as $usuario)
        <tr class="sel">        
            <td><a href="#" >{{ $usuario->name }}</a></td>
            <td><a href="#" >{{ $usuario->tipo }}</a></td>
        </tr>
        @endforeach

</table>
<div class="modal" id="modal">
    <div class="modal-content">
        <form method="POST" action="{{ route('novo.usuario') }}">
            @csrf
            <div class="painel">
                <div>
                   <h3><b> Novo Usuário </b></h3>
                   <hr>
                </div>
                <div class="container-flex"> 
                        <div class="group-flex-m">           
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" >
                        </div>
                    </div>    
                    
                    <div class="container-flex">                     
                        <div class="group-flex-m">
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" id="email" >
                        </div>
                    </div>

                    <div class="container-flex"> 
                        <div class="group-fix mb-4">
                        <label for="tipo">Perfil:</label>
                            <select name="tipo" id="tipo" >
                                @foreach ($perfis as $perfil)
                                <option value="{{ $perfil }}">
                                    {{ $perfil }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group-flex-m mb-4">
                            <label for="password">Senha:</label>
                            <input type="password" name="password" id="password" >
                        </div>
                        <button class="btn-link mb-4" type="submit">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection    
