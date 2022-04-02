@if(!empty($dadosJanus))
  <div class="card" style="margin-bottom: 0.5em;">
      <div class="card-header"><b>Dados do Janus</b></div>
      <div class="card-body">
          <b>Título:</b> {{ $dadosJanus[0]['tittrb'] ?? '' }}</br>
          <b>Palavras-chave:</b> {{ $dadosJanus[0]['palcha'] ?? '' }}</br>
          <b>Resumo:</b></br> {{ $dadosJanus[0]['rsutrb'] ?? '' }} </br>
          <b>Título em Inglês:</b> {{ $dadosJanus[0]['tittrbigl'] ?? '' }}</br>
          <b>Keywords:</b> {{ $dadosJanus[0]['palchaigl'] ?? '' }}</br>
          <b>Abstract:</b></br> {{ $dadosJanus[0]['rsutrbigl'] ?? '' }}
      </div>
  </div>
@endif