@extends('layouts.app')

@section('content')
<div class="painel">
    <a href="{{route('chamado.show','novo')}}">
        @if($perfil!='gestor')
            <button id="newTicket">Novo Ticket</button>
        @endif        
    </a>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Criado Em</th>            
            @if($perfil!='cliente')
                <th>Requerente</th>
            @endif                
            @if($perfil!='tecnico')            
                <th>Técnico</th>
            @endif                                
            @if($perfil!='cliente')
                <th>Categoria</th>            
            @endif
            <th>Situação</th>
            @if($perfil!='cliente')
                <th>Prioridade</th>
            @endif
            @if($perfil=='cliente')
                <th>Ultima Atualização</th>
            @endif
        </tr>
        @foreach ($chamados as $chamado)
        <tr>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->id }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->titulo }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ date('d/m/Y H:i', strtotime($chamado->created_at)) }}</a></td>            
            @if($perfil!='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->requerente->name }}</a></td>            
            @endif
            @if($perfil!='tecnico')
                @if(isset($chamado->tecnico->name))
                    <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->tecnico->name }}</a></td>
                @else
                    <td><a href="{{route('chamado.show',$chamado->id)}}" class="none"></a></td>
                @endif                
            @endif                
            @if($perfil!='cliente')          
                <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->categoria }}</a></td>            
            @endif
            <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->status }}</a></td>
            @if($perfil!='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->prioridade }}</a></td>
            @endif
            @if($perfil=='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" class="none">{{ $chamado->ultimaAtualizacao() }}</a></td>            
            @endif


        </tr>

        @endforeach
    </table>
</div>
@endsection