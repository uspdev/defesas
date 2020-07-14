@extends('laravel-usp-theme::master')

@section('content')
<a href="/agendamentos/create" class="btn btn-primary">Agendar Defesa</a>
</br></br>
<form method="GET" action="/agendamentos">
  <div class="row form-group">
    <div class=" col-sm form-group">
      <input type="text" class="form-control" name="busca" value="{{ Request()->busca}}">
    </div>
    <div class=" col-auto form-group">
        <button type="submit" class="btn btn-success">Buscar</button>
    </div>
  </div>
</form>

@inject('pessoa','Uspdev\Replicado\Pessoa')

<table class="table table-striped">
    <theader>
        <tr>
            <th>Nº USP</th>
            <th>Nome</th>
            <th>Data</th>
            <th>Horário</th>
            <th colspan="2">Ações</th>
        </tr>
    </theader>
    <tbody>
    @foreach ($agendamentos as $agendamento)
        <tr>
            <td>{{ $agendamento->codpes }}</td>
            <td><a href="/agendamentos/{{$agendamento->id}}">{{ $pessoa::dump($agendamento->codpes)['nompes'] }}</a></td>
            <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
            <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
            <td>
                <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar</a>
            </td>
            <td>
                <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Apagar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')
