@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    <table class="table table-striped">
        <theader>
            <tr>
                <th>Nº USP</th>
                <th>Nome</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Orientador</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file->agendamento->codpes }}</td>
                <td><a href="/agendamentos/{{$file->agendamento->id}}">{{ $file->agendamento->nome }}</a></td>
                <td>{{ Carbon\Carbon::parse($file->agendamento->data_horario)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($file->agendamento->data_horario)->format('H:i')}}</td>
                <td>{{ $pessoa::dump($file->agendamento->orientador)['nompes']}}</td>
                <td>{{ $file->status == 1 ? 'Publicado' : 'Não Publicado' }}</td>
                <td>
                    <a href="/files/{{$file->id}}/edit" class="btn btn-primary"><i class="fas fa-file-export"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $files->appends(request()->query())->links() }}
@endsection('content')
