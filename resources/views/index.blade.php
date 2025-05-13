@extends('laravel-usp-theme::master')

@section('content')
  @include('flash')
  <div class="card">
    <div class="card-header"><h5><b>Próximas Defesas</b></h5></div>
      <div class="card-body">
        <form method="GET" action="/">
          <label><b>Filtros:</b></label><br>
          <div class="row">
            <div class="col-3" id="busca_programa" >
              <select class="form-control" name="programa">
                <option value="" selected="">- Todos os programas -</option>
                @foreach ($programas as $programa)
                  @if (old('programa') == '' and isset(Request()->programa))
                  <option value="{{ $programa['codare'] }}" {{ ( Request()->programa == $programa['codare']) ? 'selected' : ''}}>
                      {{$programa['nomare']}}
                  </option>
                  @else
                  <option value="{{ $programa['codare'] }}" {{ ( old('programa') == $programa['codare']) ? 'selected' : ''}}>
                      {{$programa['nomare']}}
                  </option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="col-auto" id="busca_nivel">
              <select class="form-control" name="nivel">
                <option value="" selected="">- Escolha o nível -</option>
                @foreach ($niveis as $nivel)
                  @if (old('nivel') == '' and isset(Request()->nivel))
                  <option value="{{ $nivel }}" {{ ( Request()->nivel == $nivel) ? 'selected' : ''}}>
                      {{ $nivel }}
                  </option>
                  @else
                  <option value="{{ $nivel }}" {{ ( old('nivel') == $nivel) ? 'selected' : ''}}>
                      {{ $nivel }}
                  </option>
                  @endif
                @endforeach
              </select>
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
            </tr>
        </theader>
        <tbody>
        @forelse ($defesas as $defesa)
          <tr>
            <td>{{ $defesa['data_horario'] }}</td>
            <td>{!! $defesa['trabalho']['tittrb'] !!}</td>
            <td>{{ $defesa['aluno'] }}</td>
            <td>{{ $defesa['nivpgm'] == 'ME' ? 'Mestrado' : 'Doutorado' }}</td>
            <td>{{ $defesa['area']['nomare'] }}</td>
            <td>{{ $defesa['orientador']['nompesttd'] }}</td>
            <td>{{ $defesa['local'] }}</td>
          </tr>
        @empty
          <tr><td colspan="7">Não há defesas cadastradas.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    <br />
    {{ $agendamentos->links() }}
  </div>
@endsection('content')
