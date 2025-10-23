@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script type="text/javascript">
    $(document).ready(function() {
      $('input[type="radio"][name="filtro"]').on('change', function () {
        const selectedFiltro = this.value;
        $(".search").css("display", "none");
        $(".form-control").val('');
        $("#" + selectedFiltro + '_input').css("display", "block");
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
        <form method="GET" action="/agendamentos/search">
          <div class="row">
            <div class="col-auto">
              <label style="margin-top:0.35em; margin-bottom:0em;"><b>Filtros: </b></label>
            </div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-bottom: 1em;">
              <label class="btn btn-light">
                  <input type="radio" name="filtro" id="filtro_nome" value="nome" autocomplete="off" @checked(old('filtro', $filtro) == 'nome')> Nome
              </label>
              <label class="btn btn-light">
                  <input type="radio" name="filtro" id="filtro_codpes" value="codpes" autocomplete="off" @checked(old('filtro', $filtro) == 'codpes')> Número USP
              </label>
              <label class="btn btn-light">
                  <input type="radio" name="filtro" id="filtro_data" value="data" autocomplete="off" @checked(old('filtro', $filtro) == 'data')> Data
              </label>
            </div>
            <div class="col-md-2 search" id="nome_input" @if (old('filtro', $filtro) == 'nome')  style="display:block" @else style="display:none" @endif>
              <input type="text" class="form-control" autocomplete="off" name="nome" id="nome" value="{{ old('nome') ?? request('nome') }}" placeholder="Digite o nome">
            </div>
            <div class="col-md-2 search" id="codpes_input" @if (old('filtro', $filtro) == 'codpes')  style="display:block" @else style="display:none" @endif>
              <input type="text" class="form-control" autocomplete="off" name="codpes" id="codpes" value="{{ old('codpes') ?? request('codpes') }}" placeholder="Digite o número USP">
            </div>
            <div class="col-md-2 search" id="data_input" @if (old('filtro', $filtro) == 'data')  style="display:block" @else style="display:none" @endif>
              <input class="form-control data datepicker" autocomplete="off" name="data" name="data" value="{{ old('data') ?? request('data') }}" placeholder="Selecione a data">
            </div>
            <div class=" col-auto">
              <button type="submit" class="btn btn-success">Buscar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
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
          <div class="alert alert-danger">Nenhum registro encontrado!</div>
          @endforelse
          </tbody>
      </table>
      {{ $agendamentos->appends(request()->query())->links() }}
    @endif
@endsection('content')
