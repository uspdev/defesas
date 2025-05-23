@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script type="text/javascript">
    $(document).ready(function() {
      $("#filtro_codpes").click(function() {
          $("#busca_data").hide();
          $("#busca_codpes").show();
      });

      $("#filtro_data").click(function() {
          $("#busca_codpes").hide();
          $("#busca_data").show();
      });
    });
  </script>
@endsection('javascripts_bottom')

@section('content')
  @include('flash')
  <div class="row" style="margin-bottom: 0.5em;">
    <div class="col-sm">
      <a href="/agendamentos/create" class="btn btn-primary">Agendar Defesa</a>
    </div>
  </div>
    <div class="card">
      <div class="card-body">
        <form method="GET" action="/agendamentos">
          <div class="row">
            <div class="col-auto">
              <label style="margin-top:0.35em; margin-bottom:0em;"><b>Filtros: </b></label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-bottom: 1em;">
              <label class="btn btn-light">
                  <input type="radio" name="filtro_busca" id="filtro_codpes" value="codpes" autocomplete="off" @if(Request()->filtro_busca == 'codpes' or Request()->filtro_busca == '') checked @endif> Número USP
              </label>
              <label class="btn btn-light">
                  <input type="radio" name="filtro_busca" id="filtro_data" value="data" autocomplete="off" @if(Request()->filtro_busca == 'data') checked @endif> Data
              </label>
            </div>
            <div class="col-sm" id="busca_codpes" @if(Request()->filtro_busca == 'data') style="display:none;" @endif>
              <input type="text" class="form-control busca" autocomplete="off" name="busca_codpes" value="{{ Request()->busca_codpes }}" placeholder="Digite o número USP">
            </div>
            <div class="col-sm" id="busca_data" @if(Request()->filtro_busca == 'codpes' or Request()->filtro_busca == '') style="display:none;" @endif>
              <input class="form-control data datepicker" autocomplete="off" name="busca_data" value="{{ Request()->busca_data }}" placeholder="Selecione a data">
            </div>
            <div class=" col-auto">
              <button type="submit" class="btn btn-success">Buscar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @if(!request()->filled('busca') && !request()->filled('busca_data'))
      <div class="alert alert-info" style="margin-top:8px;">Para visualizar os agendamentos procure por algum no campo de pesquisa</div>
    @endif
    @if($agendamentos)
      <table class="table table-striped">
        <theader>
          <tr>
            <th>Nº USP</th>
            <th>Aluno</th>
            <th>Data</th>
            <th>Horário</th>
            <th colspan="2">Ações</th>
          </tr>
        </theader>
          <tbody>
          @forelse ($agendamentos as $agendamento)
            <tr>
              <td>{{ $agendamento->codpes }}</td>
              <td><a href="/agendamentos/{{$agendamento->id}}">{{ $nomes[$agendamento->codpes] }}</a></td>
              <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
              <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
              <td>
                <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
              </td>
              <td>
                <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
          @empty
          <div class="alert alert-danger">Sem registros!</div>
          @endforelse
          </tbody>
      </table>
      {{ $agendamentos->appends(request()->query())->links() }}
    @endif
@endsection('content')
