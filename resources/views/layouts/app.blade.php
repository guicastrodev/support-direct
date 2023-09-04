<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Support Direct') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/util.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <nav class="two-columns navbar bg-white shadow-sm">
                <div class="left-col mx-3">
                    <a class="navbar-brand left-col" href="{{ url('/') }}">
                        {{ config('app.name', 'Support Direct') }}
                    </a>
                </div>
                <div class="nav-item right-col mx-4">
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link" type="submit">{{ __('Sair') }}</button>
                        </form>
                    @endauth
                </div>
            </nav>
            <main class="py-4">
                @isset(Auth::user()->name)
                    <header class="mb-4">
                        <h5 class="my-2"><b>{{ Auth::user()->name }} </b></h5>
                        <h6><i>({{ Auth::user()->tipo }})</i></h6>
                    </header>
                    @auth
                        @isset($perfil)
                            @if($perfil!='cliente')
                                <nav class="menu">
                                    <ul>
                                        <li><a onclick="alertaPrototipo()" href="#">Home</a></li>
                                        <li class="{{ Request::is('tickets') ? 'active' : '' }}"><a href="{{route('tickets')}}">Tickets</a></li>
                                        @if($perfil=='gestor')
                                            <li><a onclick="alertaPrototipo()" href="#">Relatórios</a></li>
                                        @endif
                                        <li class="has-submenu">
                                            <a href="#">Configurações</a>
                                            <ul class="submenu">
                                                <li><a href="{{route('configuracoes.usuarios')}}">Usuários</a></li>
                                                <li><a href="{{route('configuracoes.categorias')}}">Categorias</a></li>
                                            </ul>
                                        </li>                                                                                
                                    </ul>
                                </nav>
                            @endif
                        @endisset
                    @endauth
                @endisset

                @yield('content')
                
            </main>
        </div>
    </body>

</html>