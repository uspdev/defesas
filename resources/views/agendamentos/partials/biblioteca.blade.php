<div class="card" style="margin-bottom: 0.5em;">
  <div class="card-header"><b>Publicação</b></div>
    <div class="card-body">
      <form method="POST" class="form-group" action="/teses/{{$agendamento->id}}/publish">
        @csrf
        @method('patch')
        <b>Publicar?</b>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="publicado1" value="1" @if($agendamento->status == 1) checked @endif>
          <label class="form-check-label" for="publicado1">
              Sim
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="publicado2" value="0" @if($agendamento->status == 0) checked @endif>
          <label class="form-check-label" for="publicado2">
              Não
          </label>
        </div>
        <div class="form-group">
          <label for="url" class="required"><b>URL:</b></label>
          <input type="text" class="form-control" name="url" value="{{ old('url', $agendamento->url) }}">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success float-right">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>
