@extends('laravel-usp-theme::master')

@section('content')

<b>Número USP</b> - <b>Nome</b> - <b>Agendamento</b><br>
@foreach($bancas_aprovadas as $aluno)
    {{ $aluno['codpes'] }} - {{ $aluno['nompes'] }}
    @if(\App\Models\Agendamento::where('codpes', $aluno['codpes'])->first() )
        {{ \App\Models\Agendamento::where('codpes', $aluno['codpes'])->first()->data_horario }}
    @endif

    <form action="{{ '/dev/codpes/'.$aluno['codpes'] }}" method="POST" class="form-horizontal">

        {{ csrf_field() }}

        <button class="btn btn-success">Importar do Janos</button>
        <br>
      
    </form>

    <br><br>
@endforeach

@endsection('content')

