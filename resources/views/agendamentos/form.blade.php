<div class="row form-group">
    <div class="col-sm form-group">
        <label for="titulo">Título da Tese</label> 
        <input type="text" name="titulo" value="{{ old('titulo', $agendamento->titulo) }}">
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="nome">Nome Completo</label> 
        <input type="text" name="nome" value="{{ old('nome', $agendamento->nome) }}">
    </div>
    <div class="col-sm form-group">
        <label for="codpes">Número USP </label> 
        <input type="text" name="codpes" value="{{ old('codpes', $agendamento->codpes) }}"> 
    </div>
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="sexo">Sexo</label>
        <select name="sexo">
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
        <select name="regimento">
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
        <select name="nivel">
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
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="area_programa">Programa</label>
        <select name="area_programa">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->programaOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('area_programa') == '' and isset($agendamento->area_programa))
                <option value="{{$option['id']}}" {{ ( $agendamento->area_programa == $option["id"]) ? 'selected' : ''}}>
                    {{$option["programa"]}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option['id']}}" {{ ( old('area_programa') == $option["id"]) ? 'selected' : ''}}>
                    {{$option["programa"]}}
                </option>
                @endif
            @endforeach
        </select> 
    </div> 
</div>



<div class="row form-group">
    <div class="col-sm form-group">
        <label for="orientador_votante">Orientador Votante</label>
        <select name="orientador_votante">
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
        <input type="text"  name="orientador" value="{{ old('orientador', $agendamento->orientador) }}"> 
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="data">Data</label> 
        <input type="text" name="data" value="{{ old('data', $agendamento->data) }}"> 
    </div>
    <div class="col-sm form-group">
        <label for="horario">Horário</label> 
        <input type="text" name="horario" value="{{ old('horario', $agendamento->horario) }}">
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <label for="sala">Local</label>
        <select name="sala">
            <option value="" selected="">- Selecione -</option>
            @foreach ($agendamento->salaOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('sala') == '' and isset($agendamento->sala))
                <option value="{{$option['id']}}" {{ ( $agendamento->sala == $option["id"]) ? 'selected' : ''}}>
                    {{$option["nome_sala"]}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option['id']}}" {{ ( old('sala') == $option["id"]) ? 'selected' : ''}}>
                    {{$option["nome_sala"]}}
                </option>
                @endif
            @endforeach
        </select> 
    </div> 
</div>

<div class="row form-group">
    <div class="col-sm form-group">
        <button type="submit">Enviar</button> 
    </div> 
</div>