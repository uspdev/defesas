@extends('laravel-usp-theme::master')

@section('content')
<a href="/agendamentos/create">Agendar Nova Defesa</a>

<div class="card">
    <div class="card-header">Editar Agendamento de Defesa</div>
    <div class="card-body">
        <form action="/agendamentos/{{$agendamento->id}}" method="POST">
            @csrf
            @method('PATCH')
            @include('agendamentos.form')
        </form>
    </div>
</div>
<a href="/agendamentos">Página Inicial</a></br>
@endsection('content')