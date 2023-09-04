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
        <tr style="width:100% !important;">
        @if($perfil=='cliente')
            <th width=3%></th>
            <th width=8% style="min-width: 57px;">ID</th>
            <th width=25% style="min-width: 290px;">Título</th>
            <th width=15% style="min-width: 127px;">Criado Em</th>            
            <th width=17% style="min-width: 130px;">Técnico</th>
            <th width=17% style="min-width: 167px;">Situação</th>
            <th width=15% style="min-width: 120px;">Ultima Atualização</th>
        @endif

        @if($perfil=='tecnico')                    
            <th width=5% style="min-width: 57px;">ID</th>
            <th width=12% style="min-width: 290px;">Título</th>
            <th width=12% style="min-width: 127px;">Criado Em</th>            
            <th width=12% style="min-width: 130px;">Requerente</th>
            <th width=10% style="min-width: 106px;">Categoria</th>            
            <th width=15% style="min-width: 167px;">Situação</th>
            <th width=7% style="min-width: 80px;">Prioridade</th>
        @endif            

        @if($perfil=='gestor')
            <th width=6% style="min-width: 57px;">ID</th>
            <th width=25% style="min-width: 290px;">Título</th>
            <th width=12% style="min-width: 127px;">Criado Em</th>            
            <th width=13% style="min-width: 130px;">Requerente</th>
            <th width=13% style="min-width: 130px;">Técnico</th>
            <th width=10% style="min-width: 106px;">Categoria</th>            
            <th width=15% style="min-width: 167px;">Situação</th>
            <th width=8% style="min-width: 80px;">Prioridade</th>
        @endif            

        </tr>
        @foreach ($tickets as $chamado)
        <tr class="sel">
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