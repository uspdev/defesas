@extends('laravel-usp-theme::master')
@section('content')

@include('flash')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header"><b>Agendamento - Novo</b></div>
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
                  <select class="form-control" id="tipo_defesa" name="tipo_defesa">
                    @foreach ($agendamento->tipodefesaOptions() as $option)
                        {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                        @if (old('tipo') == '' and isset($agendamento->tipo))
                          <option value="{{$option}}" {{ ( $agendamento->tipo == $option) ? 'selected' : ''}}>
                              {{$option}}
                          </option>
                        {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                        @else
                          <option value="{{$option}}" {{ ( old('tipo') == $option) ? 'selected' : ''}}>
                              {{$option}}
                          </option>
                        @endif
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
