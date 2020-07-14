@extends('laravel-usp-theme::master')

@section('content')
<div class="row">
    <div class="col-sm">
        <a href="/agendamentos/create" class="btn btn-primary">Agendar Nova Defesa</a></br>
    </div>
    <div class="col-auto float-right">
        <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
            @csrf 
            @method('delete')
            <button type="submit" class="btn btn-danger">Apagar</button>
        </form>
    </div>
</div>
<br>

<div class="card">
    <div class="card-header"><h4>Editar - Agendamento de Defesa</h4></div>
    <div class="card-body">
        <form action="/agendamentos/{{$agendamento->id}}" method="POST">
            @csrf
            @method('PATCH')
            @include('agendamentos.form')
        </form>
    </div>
</div>
@endsection('content')