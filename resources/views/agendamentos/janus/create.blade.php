@extends('laravel-usp-theme::master')
@section('content')

@include('flash')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header"><b>Agendamentos - Novo</b></div>
          <div class="card-body">
            <form method="post" action="/janus">
              @csrf
              @include('agendamentos.janus.form')
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection
