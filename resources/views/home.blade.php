@extends('layouts.app')

@section('content')
<div class="painel">
    <a href="{{route('chamado.show','novo')}}">
        <button id="newTicket">Novo Ticket</button>
    </a>
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
        <tr>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->id }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->titulo }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ date('d/m/Y H:i', strtotime($chamado->created_at)) }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->status }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->categoria }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->requerente->name }}</a></td>
        </tr>

        @endforeach
    </table>
</div>
@endsection