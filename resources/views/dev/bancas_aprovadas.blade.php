@extends('laravel-usp-theme::master')

@section('content')

<b>Número USP</b> - <b>Nome</b> - <b>Agendamento</b><br>
@foreach($bancas_aprovadas as $aluno)
    {{ $aluno['codpes'] }} - {{ $aluno['nompes'] }}
    @if(\App\Models\Agendamento::where('codpes', $aluno['codpes'])->first() )
        {{ \App\Models\Agendamento::where('codpes', $aluno['codpes'])->first()->data_horario }}
    @endif
    <br>
@endforeach

@endsection('content')