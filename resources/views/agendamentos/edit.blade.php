@extends('laravel-usp-theme::master')

@section('styles')
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
@endsection('styles')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @include('flash')

    <div class="row" style="margin-bottom: 0.5em;">
        <div class="col-sm">
            <a href="/agendamentos/create" class="btn btn-primary">Agendar Nova Defesa</a></br>
        </div>
        <div class="col-auto float-right">
            <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                @csrf 
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>Editar - Agendamento de Defesa</b></div>
        <div class="card-body">
            <form action="/agendamentos/{{$agendamento->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('agendamentos.form')
            </form>
        </div>
    </div>
@endsection('content')