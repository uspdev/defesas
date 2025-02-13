@if(!empty($dadosJanus))
  <div class="card" style="margin-bottom: 0.5em;">
      <div class="card-header"><b>Dados do Janus</b></div>
      <div class="card-body">
          <b>Título:</b> {{ $dadosJanus['tittrb'] ?? '' }}</br>
          <b>Palavras-chave:</b> {{ $dadosJanus['palcha'] ?? '' }}</br>
          <b>Resumo:</b></br> {{ $dadosJanus['rsutrb'] ?? '' }} </br>
          <b>Título em Inglês:</b> {{ $dadosJanus['tittrbigl'] ?? '' }}</br>
          <b>Keywords:</b> {{ $dadosJanus['palchaigl'] ?? '' }}</br>
          <b>Abstract:</b></br> {{ $dadosJanus['rsutrbigl'] ?? '' }}
      </div>
  </div>
@endif