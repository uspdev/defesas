@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')

    <div class="row">
        <div class="col-sm">
            <a href="/agendamentos/{{$agendamento->id}}/bancas/create" class="btn btn-primary">Inserir Novo Professor</a></br>
        </div>
        <div class="col-auto float-right">
            <form method="POST" action="/agendamentos/{{ $agendamento->id }}/bancas/{{$banca->id}}">
                @csrf 
                @method('delete')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
            </form>
        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-header"><h4>Editar - Banca</h4></div>
        <div class="card-body">
            <form action="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('agendamentos.bancas.form')
            </form>
        </div>
    </div>
@endsection('content')