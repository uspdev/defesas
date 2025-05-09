<div class="card" style="margin-bottom: 0.5em;">
  <div class="card-header"><b>Dados da tese</b></div>
    <div class="card-body">
      <b>Título:</b> {!! $agendamento->trabalho['tittrb'] ?? '' !!}</br>
      <b>Palavras-chave:</b> {{ $agendamento->trabalho['palcha'] ?? '' }}</br>
      <b>Resumo:</b></br> {!! $agendamento->trabalho['rsutrb'] ?? '' !!} </br>
      <b>Título em Inglês:</b> {!! $agendamento->trabalho['tittrbigl'] ?? '' !!}</br>
      <b>Keywords:</b> {{ $agendamento->trabalho['palchaigl'] ?? '' }}</br>
      <b>Abstract:</b></br> {!! $agendamento->trabalho['rsutrbigl'] ?? '' !!}
    </div>
  </div>
</div>
