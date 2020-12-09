@extends('laravel-usp-theme::master')

@section('styles')
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
@endsection('styles')

@section('javascripts_head')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header">Registrar Agendamento de Defesa</div>
        <div class="card-body">
            <form action="/agendamentos" method="POST">
                @csrf
                @include('agendamentos.form')
            </form>
        </div>
    </div>
@endsection('content')