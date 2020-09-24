@extends('laravel-usp-theme::master')

@section('content')
    @include('flash')
    <div class="row">
        <div class="col-sm">
            <a href="/" class="float-right"><h3>Próximas defesas</h3></a>
        </div>
    </div>
    @inject('replicado','App\Utils\ReplicadoUtils')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    <br>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/anteriores">
                <div class="row form-group">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><h5><b>Busca por Área/Programa: </b></h5></label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm form-group">
                        <select class="form-control" name="busca">
                            <option value="" selected="">- Todos -</option>
                            @foreach (App\Models\Agendamento::programaOptions() as $option)
                                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                @if (old('busca') == '' and isset($agendamento->busca))
                                <option value="{{$option['codare']}}" {{ ( $agendamento->busca == $option['codare']) ? 'selected' : ''}}>
                                    {{$option['nomare']}}
                                </option>
                                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                @else
                                <option value="{{$option['codare']}}" {{ ( old('busca') == $option['codare']) ? 'selected' : ''}}>
                                    {{$option['nomare']}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-auto form-group">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><h2>Defesas anteriores</h2></div>
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
                    <td>{{ $pessoa::dump($agendamento->orientador)['nompes'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $agendamentos->appends(request()->query())->links() }}
    </div>
@endsection('content')