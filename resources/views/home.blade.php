@extends('layouts.app')

@section('content')
<header>
    <h5>{{ Auth::user()->name }}</h5>
</header>
<div class="painel">
    <button id="newTicket">Novo Ticket</button>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Criado Em</th>
            <th>Situação</th>
            <th>Categoria</th>
            <th>Requerente</th>
        </tr>
        @foreach ($chamados as $chamado)
        <a href="http://www.google.com.br">
            <tr>
                <td>{{ $chamado->id }}</td>
                <td>{{ $chamado->titulo }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($chamado->created_at)) }}</td>
                <td>{{ $chamado->status }}</td>
                <td>{{ $chamado->categoria }}</td>
                <td>{{ $chamado->requerente->name }}</td>
            </tr>
        </a>
        @endforeach
    </table>
</div>
@endsection