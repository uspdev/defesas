@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')

    <div class="card">
        <div class="card-header">Cadastrar Docente</div>
        <div class="card-body">
            <form action="/docentes" method="POST">
                @csrf
                @include('docentes.form')
            </form>
        </div>
    </div>
@endsection('content')