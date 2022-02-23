@extends('laravel-usp-theme::master')

@section('content')
@include('agendamentos.partials.defesa')

<form method="POST" class="form-group" action="/files/{{$file->id}}">
    @csrf 
    @method('patch')
    <div class="card" style="margin-bottom: 0.5em;">
        <div class="card-header"><b>Publicação</b></div>
        <div class="card-body">
            <div>
                <p><b>Nome do Arquivo: </b>{{$file->original_name}}</p>
                <p><b>Tipo: </b>{{$file->tipo}}</p>
            </div>
            <b>Publicar?</b>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="publicado1" value="1" @if($file->status == 1) checked @endif>
                <label class="form-check-label" for="publicado1">
                    Sim
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="publicado2" value="0" @if($file->status == 0) checked @endif>
                <label class="form-check-label" for="publicado2">
                    Não
                </label>
            </div>
            <div class="form-group">
                <label for="url" class="required"><b>URL:</b></label>
                <input type="text" class="form-control" name="url" value="{{ old('url', $file->url) }}">
            </div>  
            <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Enviar</button> 
            </div>               
        </div>
    </div>
</form>
@endsection
