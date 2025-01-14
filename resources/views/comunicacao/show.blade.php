@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
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
                    <p><b>Orientador:</b> {{ $comunicacao::dadosProfessor($comunicacao->orientador)['nompes'] }}, {{ $comunicacao::retornarDadosProfessor($comunicacao->orientador)['codpes'] }}</p>
                    <p><b>Data:</b> {{ date('d/m/Y', strtotime($comunicacao->data_horario)) }}</p>
                    <p style="text-align:justify;"><b>Resumo: </b>{{ $dadosJanus[0]['rsutrb'] }}
                </p>
            </div>
        </div>
    </div>
</div>


@endsection