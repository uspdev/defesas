@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')
    
    <div class="row">
        <div class="col-sm">
            <a href="/anteriores" class="float-right"><h3>Defesas anteriores</h3></a>
        </div>
    </div>
    @inject('replicado','App\Utils\ReplicadoUtils')
    <br>
    <div class="card">
        <div class="card-header"><h2>Próximas Defesas</h2></div>
        <table class="table table-striped" style="text-align:center;">
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
                    <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y H:i') }}</td>
                    <td>{{ $agendamento->sala }}</td>
                    <td>{{ $replicado::nomeAreaPrograma($agendamento->area_programa) }}</td>
                    <td>{{ $agendamento->nome }}</td>
                    <td>{{ $agendamento->nivel }}</td>
                    <td>{{ $agendamento->titulo }}</td>
                    <td>{{ $agendamento->nome_orientador }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $agendamentos->appends(request()->query())->links() }}
    </div>
@endsection('content')