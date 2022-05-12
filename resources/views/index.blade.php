@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascripts_bottom')

@section('content')
    @include('flash')
    @inject('replicado','App\Utils\ReplicadoUtils')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    <div class="card">
        <div class="card-header"><h5><b>Próximas Defesas</b></h5></div>
        <div class="card-body">
            <form method="GET" action="/">
                <label><b>Filtros:</b></label><br>
                <div class="row">
                    <div class="col-3" id="busca_programa" > 
                        <select class="form-control" name="busca_programa">
                            <option value="" selected="">- Todos os programas -</option>
                            @foreach (App\Models\Agendamento::programaOptions() as $option)
                                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                @if (old('busca_programa') == '' and isset(Request()->busca_programa))
                                <option value="{{$option['codare']}}" {{ ( Request()->busca_programa == $option['codare']) ? 'selected' : ''}}>
                                    {{$option['nomare']}}
                                </option>
                                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                @else
                                <option value="{{$option['codare']}}" {{ ( old('busca_programa') == $option['codare']) ? 'selected' : ''}}>
                                    {{$option['nomare']}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto" id="busca_nivel"> 
                        <select class="form-control" name="busca_nivel">
                            <option value="" selected="">- Escolha o nível -</option>
                            @foreach (App\Models\Agendamento::nivelOptions() as $option)
                                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                @if (old('busca_nivel') == '' and isset(Request()->busca_nivel))
                                <option value="{{$option}}" {{ ( Request()->busca_nivel == $option) ? 'selected' : ''}}>
                                    {{$option}}
                                </option>
                                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                @else
                                <option value="{{$option}}" {{ ( old('busca_nivel') == $option) ? 'selected' : ''}}>
                                    {{$option}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" name="busca" placeholder="Digite o nome do candidato, nome do orientador ou o título da tese" value="{{Request()->busca}}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <table class="table table-striped" style="text-align:center;">
            <theader>
                <tr>
                    <th>Data e Horário</th>
                    <th>Título</th>
                    <th>Candidato(a)</th>
                    <th>Nível</th>
                    <th>Programa</th>
                    <th>Orientador</th>
                    <th>Local</th>
                    <th>Banca</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->data_horario ? Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y H:i') : null}}</td>
                    <td>{{ $agendamento->titulo }}</td>
                    <td>{{ $agendamento->nome }}</td>
                    <td>{{ $agendamento->nivel }}</td>
                    <td>{{ $replicado::nomeAreaPrograma($agendamento->area_programa) }}</td>
                    <td>{{ $pessoa::dump($agendamento->orientador)['nompes'] }}</td>
                    <td>{{ $agendamento->sala }}</td>
                    <td> 
                        @foreach ($agendamento->bancas()->where('tipo', 'Titular')->get() as $banca)
                            {{ $agendamento->dadosProfessor($banca->codpes)->nome }} ({{ $agendamento->dadosProfessor($banca->codpes)->lotado  ?? ''}})@if($loop->count != $loop->iteration), @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')