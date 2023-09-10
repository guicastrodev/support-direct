<h2>#{{$chamado->id}}: {{$chamado->titulo}}</h2>
<h3>Status: {{$chamado->status}}</h3>
@foreach($chamado->iteracoes as $iteracao)
<p>{{$iteracao->descricao}}<hr>
    {{$iteracao->usuario->name}} - {{Carbon\Carbon::parse($iteracao->datahora)->format('d/m/Y H:i:s')}} - Anexos: [
        @foreach($iteracao->anexos as $anexo)
        <a href="{{$anexo->localizacao}}{{$anexo->hashftp}}">{{$anexo->nome}}</a>
        @endforeach
    ]
</p>
@endforeach