@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<div class="row">
  <div class="col">
    <b>Defesas defendidas nos últimos três meses</b><hr/>
  </div>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Data da Defesa</th>
    </tr>
  </thead>
  <tbody>
    @foreach($defesas as $defesa)
    <tr>
      <td>
        <a href="/comunicacao/{{ $defesa['id'] }}">
          {!! $defesa['titulo']['tittrb'] !!}
        </a>
        <td>
          {{ $defesa['nome'] }}
        </td>
      <td>{{ $defesa['data_horario'] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $agendamentos->appends(request()->query())->links() }}
@endsection
