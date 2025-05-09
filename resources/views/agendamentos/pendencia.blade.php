@extends('laravel-usp-theme::master')
@section('content')
  @include('flash')
  <div class="card">
    <div class="card-header"><b>Agendamentos virtuais sem o link da sala virtual</b></div>
      <div class="card-body">
        <form method="GET" action="/pendencia_sala_virtual">
          <div class="row">
            <div class="col-sm-2">
              <input type="text" name="busca" class="form-control" placeholder="Procurar por Nº USP do aluno"/>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </div>
        </form>
      </div>
  </div>
  <table class="table table-striped">
    <theader>
      <tr>
        <th>Nº USP</th>
        <th>Aluno</th>
        <th>Título do trabalho</th>
        <th>Nível</th>
        <th>Data/Hora</th>
        <th>Email Enviado</th>
        <th colspan="2">Ações</th>
      </tr>
    </theader>
    <tbody>
    @forelse ($agendamentos as $agendamento)
      <tr>
        <td>{{ $agendamento['codpes'] }}</td>
        <td><a href="/agendamentos/{{ $agendamento['id'] }}">{{ $agendamento['aluno'] }}</a></td>
        <td>{!! $agendamento['trabalho']['tittrb'] !!}</td>
        <td>{{ $agendamento['nivpgm'] }}</td>
        <td>{{ Carbon\Carbon::parse($agendamento['data_horario'])->format('d/m/Y H:i') }}</td>
        <td>{{ $agendamento['enviar_email'] ? 'Sim' : 'Não' }}</td>
        <td>
          <a href="/agendamentos/{{ $agendamento['id'] }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan='7'>Não foi encontrado nenhum registro</td>
      </tr>
    @endforelse
    </tbody>
  </table>
@endsection('content')

