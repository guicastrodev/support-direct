@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#usuarios">Configuração de Usuários</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#categorias">Configuração de Categorias</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="usuarios">
        @include('configuracoes.usuarios', ['usuarios' => $usuarios])
        </div>
        <div class="tab-pane fade" id="categorias">

        </div>
    </div>
</div>
@endsection