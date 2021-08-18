    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Defesa</b></div>
        <div class="card-body">
            <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
            <b>Candidato:</b> {{$agendamento->nome }} </br>
            @can('logado')
                <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
                <b>Sexo:</b> {{$agendamento->sexo}}</br>
                <b>Regimento:</b> {{$agendamento->regimento}}</br>
            @endcan
            <b>Nível:</b> {{$agendamento->nivel}}</br>
            <b>Programa:</b> {{$agendamento->nome_area}}</br>
            @can('logado')<b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>@endcan
            <b>Orientador:</b> {{$agendamento->dadosProfessor($agendamento->orientador)->nome ?? 'Professor não cadastrado'}}</br>
            <b>Data:</b> {{$agendamento->data}}</br>
            <b>Horário:</b> {{$agendamento->horario}}</br>
            <b>Local:</b> {{$agendamento->sala}}</br>
        </div>
    </div>