@extends('laravel-usp-theme::master')

@section('styles')
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
@endsection('styles')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header"><b>Registrar Agendamento de Defesa</b></div>
        <div class="card-body">
            <form action="/agendamentos" method="POST">
                @csrf
                @include('agendamentos.form')
            </form>
        </div>
    </div>
@endsection('content')