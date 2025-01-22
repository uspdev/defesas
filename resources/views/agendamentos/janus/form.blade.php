<div class="row">
    <div class="col">
        <label for="codpes">Insira o número USP</label>
        <input type="text" class="form-control" name="codpes" value="{{ old('codpes', $agendamento->codpes) }}" placeholder="Insira o número USP">
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="sala">Sala</label>
        <input type="text" class="form-control" name="sala" value="{{old('sala', $agendamento->sala) }}" placeholder="Insira a sala">
    </div>
    <div class="col">
    <label for="tipo_defesa">Tipo da Defesa</label>
        <select class="form-control" name="tipo_defesa">
            @foreach($agendamento::tipoDefesaOptions() as $option)
                <option value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
    <label for="regimento">Regimento</label>
        <select class="form-control" name="regimento">
            @foreach($agendamento::regimentoOptions() as $option)
                <option value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>

    <div class="col">
        <label for="orientador_votante">Orientador Votante</label>
        <select class="form-control" name="orientador_votante">
            @foreach($agendamento::orientadorvotanteOptions() as $option)
                <option value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="data_horario">Data</label>
        <input class="form-control datepicker data" type="text" autocomplete="off" name="data" placeholder="Insira o dia da defesa">
    </div>
    <div class="col">
        <label for="data_horario">Horário</label>
        <input class="form-control horario" type="text" name="horario" placeholder="Insira o horário">
    </div>
</div>

<div class="row">
    <div class="col">
        <button type="submit" class="btn btn-success">Cadastrar Defesa</button>
    </div>
</div>

<style>
    .row{
        margin-top:5px;
    }
</style>