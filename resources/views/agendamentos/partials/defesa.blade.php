    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Defesa</b></div>
        <div class="card-body">
            <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
            <b>Candidato:</b> {{$agendamento->nome }} </br>
            @can('logado')
                <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
                <b>Regimento:</b> {{$agendamento->regimento}}</br>
            @endcan
            <b>Nível:</b> {{$agendamento->nivel}}</br>
            <b>Programa:</b> {{$agendamento->nome_area}}</br>
            @can('logado')<b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>@endcan
            <b>Orientador:</b> {{$agendamento->nome_orientador ?? $agendamento->dadosProfessor($agendamento->orientador)->nome}} @if($agendamento->co_orientador) e {{$agendamento->nome_co_orientador ?? $agendamento->dadosProfessor($agendamento->co_orientador)->nome}} @endif</br>
            <b>Data:</b> {{$agendamento->data}}</br>
            <b>Horário:</b> {{$agendamento->horario}}</br>
            <b>Local:</b> {{$agendamento->sala}}</br>
	    <b>Tipo da Defesa:</b> {{$agendamento->tipo}}</br>
            @if($agendamento->status == 1)
                <b>URL:</b> {{$agendamento->url}}</br>
                <b>Data de Publicação:</b> {{Carbon\Carbon::parse($agendamento->data_publicacao)->format('d/m/Y')}}</br>
                <b>Responsável Biblioteca:</b> {{$agendamento->nomeUsuario($agendamento->user_id_biblioteca)}}</br>
            @endif
        </div>
    </div>
