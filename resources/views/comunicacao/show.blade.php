@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<div class="container">
  <div class="card">
    <div class="card-header"><b class="text-center">Informações sobre a defesa</b></div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <p><b>Título:</b> {{ $agendamento->titulo }}</p>
            <p><b>Autor:</b> {{ $agendamento->aluno }}, {{ $agendamento->codpes }}</p>
            <p><b>Orientador:</b> {{ $agendamento->orientador['nompesttd'] }}, {{ $agendamento->orientador['codpes'] }}</p>
            <p><b>Data da defesa:</b> {{ date('d/m/Y', strtotime($agendamento->data_horario)) }}</p>
            <p style="text-align:justify;"><b>Resumo: </b>{!! $agendamento->trabalho['rsutrb'] ?? 'não cadastrado' !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
