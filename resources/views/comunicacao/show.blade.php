@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<form method="POST" action="/comunicacao/{{$comunicacao->id}}">
    @csrf
    @method("PATCH")
<div class="container">
    <div class="card">
        <div class="card-header">
            <b class="text-center">Informações sobre o agendamento</b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <p><b>Título:</b> {{ $comunicacao->titulo }}</p>
                    <p><b>Autor:</b> {{ $comunicacao->nome }}, {{ $comunicacao->codpes }}</p>
                    <p><b>Orientador:</b> {{ $comunicacao->docente->nome }}, {{ $comunicacao->orientador }}</p>
                    <p><b>Data:</b> {{ date('d/m/Y', strtotime($comunicacao->data_horario)) }}</p>
                </div>
                <div class="col">
                    <p><b>Resumo: </b>{{ $comunicacao->resumo }}
                </p>
            </div>
        </div>
        <hr />
                <button type="submit" class="btn btn-success" name="agendamento_id" value="{{$comunicacao->id}}">Placeholder</button>
            </form>
        </div>
    </div>
</div>


@endsection