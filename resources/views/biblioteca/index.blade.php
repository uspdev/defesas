@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    <div class="card">
        <div class="card-header">Busca</div>
        <div class="card-body">
            <form method="GET" action="{{ $action }}">
                <div class="row">
                    <div class="col-sm">
                        <input type="text" name="term" class="form-control"/>
                    </div>
                    <div class=" col-auto">
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
                <th>Nome</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Orientador</th>
                <th colspan="2">Ações</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $agendamento->codpes }}</td>
                <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->nome }}</a></td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
                <td>{{ $pessoa::dump($agendamento->orientador)['nompes']}}</td>
                <td>
                    <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')
