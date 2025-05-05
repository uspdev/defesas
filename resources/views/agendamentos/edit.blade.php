@extends('laravel-usp-theme::master')
@section('content')

@include('flash')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header"><b>Agendamento - Alteração</b></div>
          <div class="card-body">
            <form method="post" action="/agendamentos/{{ $agendamento->id }}">
              @csrf
              @method('PATCH')
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label>Aluno: <b>{{ $agendamento->codpes }} - {{ $agendamento->aluno }}</b></label>
                </div>
                <div class="form-group col-md-6">
                  <label for="sala">Sala</label>
                  <input type="text" class="form-control" id="sala" name="sala" value="{{ old('sala', $agendamento->sala) }}"  placeholder="Insira a sala">
                </div>

                <div class="form-group col-md-3">
                  <label for="data">Data</label>
                  <input type="text" class="form-control datepicker data" id="data" name="data" autocomplete="off" value="{{ old('data', date('d/m/Y', strtotime($agendamento->data_horario))) }}" placeholder="Insira o dia da defesa">
                </div>
                <div class="form-group col-md-3">
                  <label for="horario">Horário</label>
                  <input type="text" class="form-control horario" id="horario" name="horario" value="{{ old('horario', date('H:i', strtotime($agendamento->data_horario))) }}" placeholder="Insira o horário">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="tipo_defesa">Tipo da Defesa</label>
                  <select class="form-control" id="tipo" name="tipo">
                    @foreach ($agendamento->tipos() as $tipo)
                      <option value="{{ $tipo }}" @if (old('tipo_defesa', $agendamento->tipo) == $tipo) selected @endif>
                        {{ $tipo }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-9">
                  <label for="link">Link da sala virtual</label>
                  <input type="text" class="form-control" id="sala_virtual" name="sala_virtual" value="{{ old('sala_virtual', $agendamento->sala_virtual) }}" placeholder="Insira o link da sala virtual">
                </div>
              </div>
              <button type="submit" class="btn btn-success">Alterar Defesa</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
