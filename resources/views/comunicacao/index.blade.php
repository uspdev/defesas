@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<div class="col">
    <b>Defesas aprovadas</b>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Orientador</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    @foreach($agendamentos as $agendamento)
    <tr>
        <td>{{$agendamento->titulo ?? ''}}
          <td>
            <a href="/comunicacao/{{$agendamento->id}}">
            <div>
                {{$agendamento->nome ?? ''}}
              </div>
            </a>
          </td>
          <td> {{$agendamento->docente->nome ?? ''}} </td>
        <td> {{date('d/m/Y', strtotime($agendamento->data_horario)) ?? ''}} </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $agendamentos->appends(request()->query())->links() }}

@endsection