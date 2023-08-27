@extends('layouts.app')

@section('content')
<div class="painel">
    <div class="container-flex">
    @if($perfil!='gestor')
        <a class="btn-img btn-left"  title="Novo Ticket" href="{{route('chamado.show','novo')}}"><img src="{{ asset('img/ico-new-ticket.png') }}"></a>
    @endif        
    @if($perfil=='cliente')
        <a class="btn-img btn-right"  title="Exportar Dados" href="{{route('chamado.show','novo')}}"><img src="{{ asset('img/ico-export.png') }}"></a>    
    @endif   
    </div>
    <table>
        <tr>
            @if($perfil=='cliente')
                <th></th>
            @endif   
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
        @foreach ($tickets as $chamado)
        <tr class="trsel">
            @if($perfil=='cliente')
                <th><input type="checkbox"></th>
            @endif   
            <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->id }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->titulo }}</a></td>
            <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ date('d/m/Y H:i', strtotime($chamado->created_at)) }}</a></td>            
            @if($perfil!='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->requerente->name }}</a></td>            
            @endif
            @if($perfil!='tecnico')
                @if(isset($chamado->tecnico->name))
                    <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->tecnico->name }}</a></td>
                @else
                    <td><a href="{{route('chamado.show',$chamado->id)}}" ></a></td>
                @endif                
            @endif                
            @if($perfil!='cliente')          
                <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->categoria }}</a></td>            
            @endif
            <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->status }}</a></td>
            @if($perfil!='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->prioridade }}</a></td>
            @endif
            @if($perfil=='cliente')
                <td><a href="{{route('chamado.show',$chamado->id)}}" >{{ $chamado->ultimaAtualizacao() }}</a></td>            
            @endif


        </tr>

        @endforeach
    </table>
</div>
@endsection