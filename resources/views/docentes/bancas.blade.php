@extends('laravel-usp-theme::master')

@section('content')
  <div class="card" style="margin-bottom:0.5em;">
    <div class="card-header"><b>Docente</b></div>
      <div class="card-body">
        <b>Nome Completo: </b>{{ $nome }} </br>
        <b>Nº USP: </b>{{ $nusp }}</br>
        <b>E-mail: </b>{{ $email }}</br>
      </div>
  </div>
  <div class="card" style="margin-bottom:0.5em;">
    <div class="card-header"><b>Bancas que participou como Orientador(a)</b></div>
      <table class="table table-striped">
        <thead class="thead-light">
          <tr>
            <th>Candidato</th>
            <th>Título</th>
            <th>Data</th>
            <th>Programa/Área</th>
            <th>Nível</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bancasOrientador as $banca)
            <tr>
              <td><a href="/agendamentos/{{ $banca['id'] }}">{{ $banca['aluno'] }}</a></td>
              <td>{!! $banca['titulo']['tittrb'] !!}</td>
              <td>{{ $banca['data'] }}</td>
              <td>{{ $banca['area']['nomare'] }}</td>
              <td>{{ $banca['nivpgm'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
  <div class="card">
    <div class="card-header"><b>Bancas de defesa que participou como Examinador(a)</b></div>
      <table class="table table-striped">
        <thead class="thead-light">
          <tr>
            <th>Candidato</th>
            <th>Título</th>
            <th>Data</th>
            <th>Programa/Área</th>
            <th>Nível</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bancasExaminador as $banca)
            <tr>
              <td><a href="/agendamentos/{{ $banca['id'] }}">{{ $banca['aluno'] }}</a></td>
              <td>{!! $banca['titulo']['tittrb'] !!}</td>
              <td>{{ $banca['data'] }}</td>
              <td>{{ $banca['area']['nomare'] }}</td>
              <td>{{ $banca['nivpgm'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@endsection('content')

