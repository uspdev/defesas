@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')
    <h2>Defesas Anteriores</h2>

    @inject('pessoa','Uspdev\Replicado\Pessoa')

    <table class="table table-striped">
        <theader>
            <tr>
                <th>Data defesa</th>
                <th>Local</th>
                <th>Programa/Área</th>
                <th>Nome</th>
                <th>Nível</th>
                <th>Título</th>
                <th>Orientador(a)</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $pessoa::dump($agendamento->codpes)['nompes'] }}</td>
                <td>{{ $pessoa::dump($agendamento->orientador)['nompes'] }}</td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection('content')