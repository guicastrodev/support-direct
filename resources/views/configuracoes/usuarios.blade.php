@extends('layouts.app')
@section('content')
<div class="painel">
    <div class="container-flex title">
        <div class="group-title">
            <button onclick="openModal()" title="Novo Usuário"><img src="{{ asset('img/ico-add-user.png') }}"></button>            
            <a>Usuários</a>                
        </div>
    </div>
    <table>
        <tr>
            <th style="width:80vw; min-width: 290px;">Nome</th>
            <th style="width:20vw; min-width: 57px;">Perfil</th>
        </tr>
        @foreach($usuarios as $usuario)
        <tr class="sel">        
            <td><a href="{{route('configuracoes.usuario', $usuario->id)}}" >{{ $usuario->name }}</a></td>
            <td><a href="{{route('configuracoes.usuario', $usuario->id)}}" >{{ $usuario->perfil->nome }}</a></td>
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
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" required>
                        </div>
                    </div>    
                        
                    <div class="container-flex">                     
                        <div class="group-flex-m">
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="container-flex"> 
                        <div class="group-fix mb-4 ml-0">
                            <label for="perfil">Perfil:</label>
                                <select name="perfil" id="perfil" >
                                    @foreach ($perfis as $perfil)
                                    <option value="{{ $perfil->id }}">
                                        {{ $perfil->nome }}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="group-fix mb-4 mr-1" id="dp-group">
                            <label for="departamento">Departamento:</label>
                                <select name="departamento" id="departamento" >
                                    @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">
                                        {{ $departamento->nome }}
                                    </option>
                                    @endforeach
                                </select>
                        </div>                        
                        <div class="group-flex-m mb-4">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" required>
                        </div>
                    </div>
                        <div class="container-flex"> 
                            <a class="btn-img" onclick="closeModal()" title="Cancelar Inclusão"><img src="{{ asset('img/ico-cancel.png') }}"></a>                        
                            <button class="btn-img" type="submit" title="Gravar Inclusão"><img src="{{ asset('img/ico-done.png') }}"></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>        
@endsection    
