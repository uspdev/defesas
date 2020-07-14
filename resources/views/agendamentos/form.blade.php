@inject('pessoa','Uspdev\Replicado\Pessoa')

<div class="form-group">
    <label for="titulo">Título da Tese</label> 
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $agendamento->titulo) }}">
</div> 

<div class="form-group row">
    <div class="col-sm form-group">
        <label for="nome">Nome Completo</label>
        {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
        @if ($agendamento->codpes != '')
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $pessoa::dump($agendamento->codpes)['nompes']) }}">
        {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
        @else
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
        @endif
    </div>
    <div class="col-sm form-group">
        <label for="codpes">Número USP </label> 
        <input type="text" name="codpes" class="form-control" value="{{ old('codpes', $agendamento->codpes) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="sexo">Sexo</label>
        <select class="form-control" name="sexo">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->sexoOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('sexo') == '' and isset($agendamento->sexo))
                <option value="{{$option}}" {{ ( $agendamento->sexo == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('sexo') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm form-group">
        <label for="regimento">Regimento</label>
        <select class="form-control" name="regimento">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->regimentoOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('regimento') == '' and isset($agendamento->regimento))
                <option value="{{$option}}" {{ ( $agendamento->regimento == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('regimento') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select> 
    </div>
    <div class="col-sm form-group">
        <label for="nivel">Nível</label>
        <select class="form-control" name="nivel">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->nivelOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('nivel') == '' and isset($agendamento->nivel))
                <option value="{{$option}}" {{ ( $agendamento->nivel == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('nivel') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select> 
    </div>
    <div class="col-sm form-group">
        <label for="area_programa">Programa</label>
        <select class="form-control" name="area_programa">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->programaOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('area_programa') == '' and isset($agendamento->area_programa))
                <option value="{{ $option }}" {{ ( $agendamento->area_programa == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('area_programa') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select> 
    </div>   
</div>
<div class="row form-group">
    <div class="col-sm form-group">
        <label for="orientador_votante">Orientador Votante</label>
        <select class="form-control" name="orientador_votante">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->orientadorvotanteOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('orientador_votante') == '' and isset($agendamento->orientador_votante))
                <option value="{{$option}}" {{ ( $agendamento->orientador_votante == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option}}" {{ ( old('orientador_votante') == $option) ? 'selected' : ''}}>
                    {{$option}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-sm form-group">
        <label for="orientador">Orientador</label>
        {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
        @if ($agendamento->orientador != '')
            <input type="text"  name="orientador" class="form-control" value="{{ old('orientador', $pessoa::dump($agendamento->orientador)['nompes']) }}"> 
        {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
        @else
            <input type="text" name="nome" class="form-control" value="{{ old('orientador') }}">
        @endif 
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="data">Data</label> 
        <input type="text" name="data" class="form-control" value="{{ old('data', $agendamento->data) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="horario">Horário</label> 
        <input type="text" name="horario" class="form-control" value="{{ old('horario', $agendamento->horario) }}">
    </div> 
</div>

<div class="form-group">
    <label for="sala">Local</label>
    <select class="form-control" name="sala">
        <option value="" selected="">- Selecione -</option>
        @foreach ($agendamento->salaOptions() as $option)
            {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
            @if (old('sala') == '' and isset($agendamento->sala))
            <option value="{{$option}}" {{ ( $agendamento->sala == $option) ? 'selected' : ''}}>
                {{$option}}
            </option>
            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
            @else
            <option value="{{$option}}" {{ ( old('sala') == $option) ? 'selected' : ''}}>
                {{$option}}
            </option>
            @endif
        @endforeach
    </select> 
</div> 
<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
