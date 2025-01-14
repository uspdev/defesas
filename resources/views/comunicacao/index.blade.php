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
      <th scope="col">Resumo</th>
      <th scope="col">Orientador</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    @foreach($agendamentos as $agendamento)
    <tr>
        <td>{{$agendamento->titulo}} 
          @if($agendamento->agendamento_id == $agendamento->id) 
            <p class="text-success"><b>Divulgado</b></p>
          @endif</td>
          <td>
            <a href="/comunicacao/{{$agendamento->id}}">
            <div>
                {{$agendamento->nome}}
              </div>
            </a>
          </td>
        <td><p> {{ $dadosJanus[0]['rsutrb'] }} </p> </td>
        <td> {{\App\Models\Agendamento::dadosProfessor($agendamento->orientador)['nompes']}} </td>
        <td> {{date('d/m/Y', strtotime($agendamento->data_horario))}} </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $agendamentos->appends(request()->query())->links() }}
  
<style>
  p{
    text-align:justify;
    display:inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 120ch;"
  }
</style>

@endsection