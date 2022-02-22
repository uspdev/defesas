<form action="/files" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
    <input type="hidden" name="tipo" value="trabalho">
    <div class="row">
        <div class="col-sm">
            <label for="arquivo-do-trabalho" class="required"><b>Arquivo do Trabalho</b></label>
            <input type="file" class="form-control-file" id="arquivo-do-trabalho" name="file">
            <span class="badge badge-warning"><b>Atenção:</b> Os arquivos a serem enviados devem ter no máximo 12mb.</span><br>
        </div>
        <div class="col-auto">
            <button type="submit" style="margin-top:2.98em" class="btn btn-success float-right">Enviar</button> 
        </div>
    </div>     
</form>
