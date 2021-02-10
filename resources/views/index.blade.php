@extends('laravel-usp-theme::master')

@section('javascripts_head')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')
    
    <div class="row">
        <div class="col-sm">
            <a href="/anteriores" class="float-right"><h3>Defesas anteriores</h3></a>
        </div>
    </div>
    @inject('replicado','App\Utils\ReplicadoUtils')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    <br>
    <div class="card">
        <div class="card-header"><h5><b>Pesquisa</b></h5></div>
        <div class="card-body">
            <form method="GET" action="/">
                <label><b>Filtros:</b></label><br>
                <div class="row form-group" style="margin-top:0em; margin-bottom:0em;">
                    <div class="col-1 form-check" style="margin-left:1em; margin-bottom:0em; margin-top:0.35em;">
                        <input type="checkbox" class="form-check-input" name="programa" id="programa" autocomplete="off" @if(Request()->programa == 'on') checked @endif> 
                        <label class="form-check-label" for="programa">Programa/Área</label>
                    </div>
                    <div class="col-4 form-group" id="busca_programa"  @if(Request()->programa == '') style="display:none; margin-bottom:0em; margin-top:0em;" @else style="margin-bottom:0em; margin-top:0em;" @endif> 
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
                </div>
                <div class="row form-group" style="margin-top:0em;">
                    <div class="col-1 form-check" style="margin-left:1em; margin-bottom:0em; margin-top:0.35em;">
                        <input type="checkbox" class="form-check-input" name="nivel" id="nivel" autocomplete="off" @if(Request()->nivel == 'on') checked @endif> 
                        <label class="form-check-label" for="nivel">Nível</label>
                    </div>
                    <div class="col-4 form-group" id="busca_nivel"  @if(Request()->nivel == '') style="display:none; margin-bottom:0em; margin-top:0em;" @else style="margin-bottom:0em; margin-top:0em;" @endif> 
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
                </div>
                <div class="row form-group">
                    <div class="col-sm form-group">
                        <input type="text" class="form-control" name="busca" placeholder="Digite o nome do candidato, nome do orientador ou o título da tese" value="{{Request()->busca}}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <h2>Próximas Defesas</h2><br>
        @foreach ($agendamentos as $agendamento)
            <div class="card">
                <div class="card-header"><h5><b>Candidato(a):</b> {{$agendamento->nome}}</h5></div>
                <div class="card-body">
                    <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
                    <b>Candidato(a):</b> {{$agendamento->nome }} </br>
                    @can('logado')
                        <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
                        <b>Sexo:</b> {{$agendamento->sexo}}</br>
                        <b>Regimento:</b> {{$agendamento->regimento}}</br>
                    @endcan
                    <b>Nível:</b> {{$agendamento->nivel}}</br>
                    <b>Programa:</b> {{$replicado::nomeAreaPrograma($agendamento->area_programa)}}</br>
                    <b>Orientador:</b> {{$agendamento->dadosProfessor($agendamento->orientador)->nome ?? 'Professor não cadastrado'}}</br>
                    @can('logado')<b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>@endcan
                    <b>Data:</b> {{$agendamento->formatDataHorario($agendamento)->data}}</br>
                    <b>Horário:</b> {{$agendamento->formatDataHorario($agendamento)->horario}}</br>
                    <b>Local:</b> {{$agendamento->sala}}</br>
                    <hr>
                    <h5><b>Banca</b></h5>
                    <ul class="list-group">
                        @foreach ($agendamento->bancas as $banca)
                            @if($banca->tipo == 'Titular') <li class="list-group-item">{{ $agendamento->dadosProfessor($banca->codpes)->nome  ?? 'Professor não cadastrado'}}</li>@endif
                        @endforeach
                    </ul>
                </div>
            </div><br>
        @endforeach
    {{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')