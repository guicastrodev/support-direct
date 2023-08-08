@extends('layouts.app')

@section('content')
<header>
    <h1>{{ Auth::user()->name }}</h1>
</header>
<div class="painel">
    <button id="newTicket">Novo Ticket</button>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Criado Em</th>
            <th>Situação</th>
            <th>Última Atualização</th>
        </tr>
        <tr>
            <td>010138</td>
            <td>Problema de conexão com a internet</td>
            <td>2023-07-15 10:30</td>
            <td>Aguardando Requerente</td>
            <td>6 horas</td>
        </tr>
    </table>
</div>
@endsection