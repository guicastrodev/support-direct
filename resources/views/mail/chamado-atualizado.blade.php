<h2>#{{$chamado->id}}: {{$chamado->titulo}}</h2>
<h3>Status: {{$chamado->status}}</h3>
@foreach($chamado->interacoes as $interacao)
<p>{{$interacao->descricao}}<hr>
    {{$interacao->usuario->name}} - {{Carbon\Carbon::parse($interacao->datahora)->format('d/m/Y H:i:s')}} - Anexos: [
        @foreach($interacao->anexos as $anexo)
            @if($anexo->soVisualizar())
                <a>{{$anexo->nome}}; </a>
            @endif
        @endforeach
    ]
</p>
@endforeach