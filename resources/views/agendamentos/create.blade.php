@extends('laravel-usp-theme::master')
@section('content')

@include('flash')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header"><b>Agendamentos - Novo</b></div>
          <div class="card-body">
            <form method="post" action="/agendamentos">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="codpes">Número USP</label>
                  <input type="text" class="form-control" name="codpes" value="{{ old('codpes') }}" placeholder="Insira o número USP">
                </div>
                <div class="form-group col-md-6">
                  <label for="sala">Sala</label>
                  <input type="text" class="form-control" id="sala" name="sala" value="{{ old('sala') }}"  placeholder="Insira a sala">
                </div>

                <div class="form-group col-md-3">
                  <label for="data">Data</label>
                  <input type="text" class="form-control datepicker data" id="data" name="data" autocomplete="off" value="{{ old('data') }}" placeholder="Insira o dia da defesa">
                </div>
                <div class="form-group col-md-3">
                  <label for="horario">Horário</label>
                  <input type="text" class="form-control horario" id="horario" name="horario" value="{{ old('horario') }}" placeholder="Insira o horário">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="tipo_defesa">Tipo da Defesa</label>
                  <select class="form-control" id="tipo" name="tipo">
                    @foreach ($agendamento->tipos() as $tipo)
                      <option value="{{ $tipo }}"  @if(old('tipo') == $tipo) selected @endif>
                          {{$tipo}}
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
