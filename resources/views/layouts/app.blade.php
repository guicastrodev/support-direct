<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Support Direct') }}</title>

        <link rel="icon" href="{{ asset('img/ico-headset.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('img/ico-headset.png') }}" type="image/x-icon">        

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/util.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        
    </head>

    <body>
        <div id="app">
            <nav class="two-columns navbar bg-white shadow-sm">
                <div class="left-title mx-3">
                    <a class="navbar-brand font-linear-gradient" href="{{ url('/') }}">
                        <img src="{{ asset('img/ico-headset.png') }}">{{ config('app.name', 'Support Direct') }}
                    </a>
                </div>
                <div class="nav-item right-title mx-4">
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link" type="submit">{{ __('Sair') }}</button>
                        </form>
                    @endauth
                </div>
            </nav>
            <main class="py-4">
                @auth
                    <header class="mb-4">
                        <h5 class="my-2"><b>{{ Auth::user()->name }} </b></h5>
                        <h6><i>({{$perfil->nome}})</i></h6>
                    </header>                   
                    @if($perfil->acesso!='cliente')
                        <nav class="menu">
                            <ul class="mb-0">
                                <li><a onclick="alertaPrototipo()" href="#">Home</a></li>
                                <li class="{{ Request::is('chamados') ? 'active' : '' }}"><a href="{{route('chamados.lista')}}">Chamados</a></li>
                                @if($perfil->acesso=='gestor')
                                    <li><a onclick="alertaPrototipo()" href="#">Relatórios</a></li>
                                @endif
                                <li class="has-submenu {{ Request::is('configuracoes/usuarios') || Request::is('configuracoes/categorias') || Request::is('configuracoes/comentariospadroes') ? 'active' : '' }}">
                                    <a href="#">Configurações</a>
                                    <ul class="submenu">
                                        @if($perfil->acesso=='gestor')
                                            <li><a href="{{route('configuracoes.usuarios')}}">Usuários</a></li>
                                            <li><a href="{{route('configuracoes.categorias')}}">Categorias</a></li>
                                        @endif
                                        @if($perfil->acesso=='tecnico')
                                            <li><a href="{{route('configuracoes.comentariospadroes')}}">Comentários <br> Padrões</a></li>                                                
                                        @endif
                                    </ul>
                                </li>                                                                                
                            </ul>
                        </nav>
                    @endif
                @endauth
                @if(Session::get('mensagem'))
                    <div class="alert alert-success msg-box">
                        <p>{{Session::get('mensagem')}}</p>
                    </div>
                    {{session()->forget(['mensagem'])}}
                @endif 
                @if(Session::get('erro'))                
                    <div class="alert alert-danger msg-box">
                        <p>{{Session::get('erro')}}</p>
                    </div>
                    {{session()->forget(['erro'])}}                    
                @endif
                @yield('content')
                <div class="modal-exclusao" id="msg-box-exclusao">
                    <div class="modal-exclusao-content">
                        <span class="close-exclusao" onclick="fechaConfirmacaoExclusao()">&times;</span>
                        <p>O registro selecionado será excluido?</p>
                        <button onclick="confirmaExclusao()">Confirmar</button>
                        <button onclick="fechaConfirmacaoExclusao()">Cancelar</button>
                    </div>
                </div>
            </main>
        </div>
    </body>

</html>