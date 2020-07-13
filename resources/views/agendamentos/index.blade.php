@extends('laravel-usp-theme::master')

@section('content')
<a href="/agendamentos/create">Agendar Defesa</a>
</br></br>
<form method="GET" action="/agendamentos">
  <div class="row form-group">
    <div class=" col-sm form-group">
      <input type="text" class="form-control" name="busca" value="{{ Request()->busca}}">
        <span class="input-group-btn">
        <button type="submit" class="btn btn-success">Buscar</button>
        </span>
    </div>
  </div>
</form>

@inject('pessoa','Uspdev\Replicado\Pessoa')

<div class="card">
    <div class="card-header">Agendamentos de Defesa</div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td>Nº USP</td>
                <td>Nome</td>
                <td>Data</td>
                <td>Horário</td>
                <td>Ações</td>
            </tr>
            @foreach ($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->codpes }}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}">{{ $pessoa::dump($agendamento->codpes)['nompes'] }}</a></td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/edit">Editar</a>
                        <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                            @csrf 
                            @method('delete')
                            <button type="submit">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
{{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')
