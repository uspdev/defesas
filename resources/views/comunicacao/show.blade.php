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
                    <p><b>Título:</b> {{ $agendamento->titulo }}</p>
                    <p><b>Autor:</b> {{ $agendamento->nome }}, {{ $agendamento->codpes }}</p>
                    <p><b>Orientador:</b> {{ $agendamento->docente->nome }}, {{ $agendamento->orientador }}</p>
                    <p><b>Data:</b> {{ date('d/m/Y', strtotime($agendamento->data_horario)) }}</p>
                    <p style="text-align:justify;"><b>Resumo: </b>{{ $dadosJanus['rsutrb'] ?? $agendamento->resumo }}</p>
            </div>
        </div>
        </div>
    </div>
</div>


@endsection
