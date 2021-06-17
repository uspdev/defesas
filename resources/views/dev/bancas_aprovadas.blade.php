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

@section('flash')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a>
        </p>
        @endif
    @endforeach
    </div>
@endsection

