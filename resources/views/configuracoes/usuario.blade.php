@extends('layouts.app')
@section('content')
<div class="painel">
    <div class="container-flex title">
        <div class="group-title">
            <a>Usuário: {{$usuario->name}}</a>                
        </div>
    </div>            
    <div>
        <form method="POST" action="{{ route('configuracoes.usuario-alterar', $usuario->id)}}">            
        @csrf
        <div class="painel">
            <div class="container-flex"> 
                <div class="group-flex-m">           
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="{{$usuario->name}}" disabled>
                </div>
            </div>    
                
            <div class="container-flex">                     
                <div class="group-flex-m">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" id="email" value="{{$usuario->email}}" required>
                </div>
            </div>
            <div class="container-flex"> 
                <div class="group-fix mb-4 ml-0">
                    <label for="perfil">Perfil:</label>
                        <select name="perfil" id="perfil" >
                            @foreach ($perfis as $perfil)
                            <option value="{{ $perfil->id }}" {{ $usuario->perfilID == $perfil->id ? 'selected' : '' }}>
                                {{ $perfil->nome }}
                            </option>
                            @endforeach
                        </select>
                </div>
                <div class="group-fix mb-4 mr-1" id="dp-group">
                    <label for="departamento">Departamento:</label>
                        <select name="departamento" id="departamento" >
                            @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" {{ $usuario->pessoa->departamentoID == $departamento->id ? 'selected' : '' }}>
                                {{ $departamento->nome }}
                            </option>
                            @endforeach
                        </select>
                </div> 
                <div class="group-fix mb-4 mr-1">
                    <label for="ativo">Ativo</label>
                    <input type="checkbox" name="ativo" id="ativo" {{ $usuario->pessoa->disponibilidade ? 'checked' : '' }}>
                </div>                                        
                <div class="group-flex-m mb-4">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" value="{{$usuario->password}}" required>
                </div>
            </div>
                <div class="container-flex"> 
                    <a class="btn-img"  title="Cancelar Alterações" href="{{route('configuracoes.usuarios')}}"><img src="{{ asset('img/ico-cancel.png') }}"></a>
                    <button class="btn-img" type="submit" title="Gravar Alterações"><img src="{{ asset('img/ico-done.png') }}"></button>
                </div>
            </div>
        </div>
    </form>
</div>        
@endsection    
