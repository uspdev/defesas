<div class="form-group">
    <label for="titulo" class="required">Título da Tese</label> 
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $agendamento->titulo) }}">
</div> 

<div class="form-group row">
    <div class="col-sm form-group">
        <label for="nome">Nome Completo</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $agendamento->nome) }}">
        <span class="badge badge-warning">Se este campo ficar vazio, o nome utilizado será o cadastrado nos sistemas da USP</span>
    </div>
    <div class="col-sm form-group">
        <label for="codpes" class="required">Número USP </label> 
        <input type="text" name="codpes" class="form-control" value="{{ old('codpes', $agendamento->codpes) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="sexo" class="required">Sexo</label>
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
        <label for="regimento" class="required">Regimento</label>
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
        <label for="nivel" class="required">Nível</label>
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
        <label for="area_programa" class="required">Programa</label>
        <select class="form-control" name="area_programa">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->programaOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('area_programa') == '' and isset($agendamento->area_programa))
                <option value="{{ $option['codare'] }}" {{ ( $agendamento->area_programa == $option['codare']) ? 'selected' : ''}}>
                    {{$option['nomare']}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option['codare']}}" {{ ( old('area_programa') == $option['codare']) ? 'selected' : ''}}>
                    {{$option['nomare']}}
                </option>
                @endif
            @endforeach
        </select> 
    </div>   
</div>
<div class="row form-group">
    <div class="col-sm form-group">
        <label for="orientador_votante" class="required">Orientador Votante</label>
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
        <label for="orientador" class="required">Nº USP Orientador</label>
        <input type="text" name="orientador" class="form-control" value="{{ old('orientador', $agendamento->orientador) }}"> 
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="data" class="required">Data</label> 
        <input type="text" name="data" class="form-control datepicker data" autocomplete="off" value="{{ old('data', $agendamento->data) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="horario" class="required">Horário</label> 
        <input type="text" name="horario" class="form-control horario" value="{{ old('horario', $agendamento->horario) }}">
    </div> 
</div>

<div class="form-group">
    <label for="sala" class="required">Local</label>
    <input type="text" name="sala" class="form-control" value="{{ old('sala', $agendamento->sala) }}"> 
</div> 
<div class="form-group">
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
