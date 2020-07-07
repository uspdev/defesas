<a href="/agendamentos/create">Agendar Defesa</a></br>
<a href="/agendamentos/{{$agendamento->id}}/edit">Editar Defesa</a>

<div class="card">
    <div class="card-header">Agendamento de Defesa</div>
    <div class="card-body">
        <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
        <b>Nome:</b> {{$agendamento->nome}}</br>
        <b>Nº USP:</b> {{$agendamento->codpes}}</br>
        <b>Sexo:</b> {{$agendamento->sexo}}</br>
        <b>Regimento:</b> {{$agendamento->regimento}}</br>
        <b>Nível:</b> {{$agendamento->nivel}}</br>
        @foreach ($agendamento->programaOptions() as $option)
            @if ($option["id"] == $agendamento->area_programa)
                <b>Programa:</b> {{$option["programa"]}}</br>
            @endif
        @endforeach
        <b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>
        <b>Orientador:</b> {{$agendamento->orientador}}</br>
        <b>Data:</b> {{$agendamento->data}}</br>
        <b>Horário:</b> {{$agendamento->horario}}</br>
        @foreach ($agendamento->salaOptions() as $option)
            @if ($option["id"] == $agendamento->sala)
                <b>Local:</b> {{$option["nome_sala"]}}</br>
            @endif
        @endforeach
    </div>
</div>

<a href="/agendamentos">Página Inicial</a></br>
