@extends('laravel-usp-theme::master')

@section('content')
<div class="card">
    <div class="card-header">Registrar Agendamento de Defesa</div>
    <div class="card-body">
        <form action="/agendamentos" method="POST">
            @csrf
            @include('agendamentos.form')
        </form>
    </div>
</div>
<a href="/agendamentos">Página Inicial</a></br>
@endsection('content')