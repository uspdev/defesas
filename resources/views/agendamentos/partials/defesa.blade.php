    <div class="card">
        <div class="card-header">Defesa</div>
        <div class="card-body">
            <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
            <b>Candidato:</b> {{$agendamento->nome }} </br>
            <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
            <b>Sexo:</b> {{$agendamento->sexo}}</br>
            <b>Regimento:</b> {{$agendamento->regimento}}</br>
            <b>Nível:</b> {{$agendamento->nivel}}</br>
            @foreach ($agendamento->programaOptions() as $option)
                @if ($option == $agendamento->area_programa)
                    <b>Programa:</b> {{$option}}</br>
                @endif
            @endforeach
            <b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>
            <b>Orientador:</b> {{$agendamento->nome_orientador}}</br>
            <b>Data:</b> {{$agendamento->data}}</br>
            <b>Horário:</b> {{$agendamento->horario}}</br>
            @foreach ($agendamento->salaOptions() as $option)
                @if ($option == $agendamento->sala)
                    <b>Local:</b> {{$option}}</br>
                @endif
            @endforeach
        </div>
    </div>