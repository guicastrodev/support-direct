@extends('layouts.app')

@section('content')
    <div class="painel">
        <form action="{{route('chamados.exportar')}}" method="POST">
            @csrf
            <div class="container-flex title">
                <div class="group-title">
                        @if($perfil->acesso!='gestor')
                        <a class="title-a-btn" title="Novo Chamado" href="{{route('chamado.visualizar','novo')}}"><img src="{{ asset('img/ico-new-ticket.png') }}"> Novo</a>
                        @endif 
                        @if($perfil->acesso=='cliente')
                            <a class="title-a-center">Meus Chamados</a>                
                            <button class="btn-right"  type="submit" title="Exportar Dados"><img src="{{ asset('img/ico-export.png') }}"> Exportar</button>    
                        @else
                            <a class="title-a-center">Chamados</a>                
                        @endif   
                </div>
            </div>            
            <table>
                <tr>
                    @if($perfil->acesso=='cliente')
                        <th style="width:3vw; min-width: 10px;"></th>
                        <th style="width:8vw; min-width: 57px;">ID</th>
                        <th style="width:25vw; min-width: 290px;">Título</th>
                        <th style="width:15vw; min-width: 127px;">Criado Em</th>            
                        <th style="width:17vw; min-width: 130px;">Técnico</th>
                        <th style="width:17vw; min-width: 167px;">Situação</th>
                        <th style="width:15vw; min-width: 138px;">Ultima Atualização</th>            
                    @endif

                    @if($perfil->acesso=='tecnico')        
                        <th style="width:7vw; min-width: 57px;">ID</th>
                        <th style="width:25vw; min-width: 290px;">Título</th>
                        <th style="width:14vw; min-width: 127px;">Criado Em</th>            
                        <th style="width:17vw; min-width: 130px;">Requerente</th>
                        <th style="width:14vw; min-width: 106px;">Categoria</th>            
                        <th style="width:17vw; min-width: 167px;">Situação</th>
                        <th style="width:8vw; min-width: 80px;">Prioridade</th>
                    @endif            

                    @if($perfil->acesso=='gestor')
                        <th style="width:6vw; min-width: 57px;">ID</th>
                        <th style="width:25vw; min-width: 290px;">Título</th>
                        <th style="width:12vw; min-width: 127px;">Criado Em</th>            
                        <th style="width:13vw; min-width: 130px;">Requerente</th>
                        <th style="width:13vw; min-width: 130px;">Técnico</th>
                        <th style="width:10vw; min-width: 106px;">Categoria</th>            
                        <th style="width:15vw; min-width: 167px;">Situação</th>
                        <th style="width:8vw; min-width: 80px;">Prioridade</th>
                    @endif

                </tr>
                @foreach ($chamados as $chamado)
                <tr class="sel">
                    @if($perfil->acesso=='cliente')
                        <th><input type="checkbox" name="selecionados[]" id="selecionados[]" value="{{$chamado->id}}"></th>                        
                    @endif   
                    <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->id }}</a></td>
                    <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->titulo }}</a></td>
                    <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ date('d/m/Y H:i', strtotime($chamado->created_at)) }}</a></td>            
                    @if($perfil->acesso!='cliente')
                        <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->requerente->name }}</a></td>            
                    @endif
                    @if($perfil->acesso!='tecnico')
                        @if(isset($chamado->tecnico->name))
                            <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->tecnico->name }}</a></td>
                        @else
                            <td><a href="{{route('chamado.visualizar',$chamado->id)}}" ></a></td>
                        @endif                
                    @endif                
                    @if($perfil->acesso!='cliente')          
                        <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->categoria->nome }}</a></td>            
                    @endif
                    <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->status }}</a></td>
                    @if($perfil->acesso!='cliente')
                        <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->prioridade }}</a></td>
                    @endif
                    @if($perfil->acesso=='cliente')
                        <td><a href="{{route('chamado.visualizar',$chamado->id)}}" >{{ $chamado->ultimaAtualizacao() }}</a></td>            
                    @endif
                </tr>
                @endforeach
            </table>
        </form>            
    </div>
@endsection

