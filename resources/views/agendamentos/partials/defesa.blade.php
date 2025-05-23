<div class="card" style="margin-bottom: 0.5em;">
  <div class="card-header"><b>Defesa</b></div>
    <div class="card-body">
      <b>Candidato:</b> {{$agendamento->aluno }} </br>
      @can('logado')
          <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
      @endcan
      <b>Nível:</b> {{ $agendamento->nivpgm }}</br>
      <b>Programa:</b> {{$agendamento->area['nomare']}}</br>
      <b>Orientador:</b> {{ $agendamento->orientador['nompesttd'] }}</br>
      <b>Data:</b> {{ date('d/m/Y', strtotime($agendamento->data_horario))}} às {{date('H:i', strtotime($agendamento->data_horario))}}</br>
      <b>Local:</b> {{ $agendamento->sala }}</br>
      @if($agendamento->tipo == 'Virtual' || $agendamento->tipo == 'Hibrido')
      <b>Link da Sala Virtual: </b>{{ $agendamento->sala_virtual ?? 'não cadastrado' }}<br/>
      @endif
      <b>Tipo da Defesa:</b> {{ $agendamento->tipo }}</br>
      @if($agendamento->status == 1)
          <b>URL:</b> {{$agendamento->url}}</br>
          <b>Data de Publicação:</b> {{ Carbon\Carbon::parse($agendamento->data_publicacao)->format('d/m/Y') }}</br>
          <b>Responsável Biblioteca: </b> {{ $agendamento->user->name }}, {{ $agendamento->user->codpes }}
      @endif
    </div>
  </div>
</div>
