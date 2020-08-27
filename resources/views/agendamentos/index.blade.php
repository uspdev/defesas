@extends('laravel-usp-theme::master')

@section('javascripts_head')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')

    <a href="/agendamentos/create" class="btn btn-primary">Agendar Defesa</a>
    </br></br>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/agendamentos">
                <div class="row form-group">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><h5><b>Busca por: </b></h5></label>
                    </div>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="numero_usp" value="numero_usp" autocomplete="off" @if(Request()->filtro_busca == 'numero_usp' or Request()->filtro_busca == null) checked @endif> Número USP
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="data" value="data" autocomplete="off" @if(Request()->filtro_busca == 'data') checked @endif> Data
                        </label>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-sm form-group" id="busca_nusp"  @if(Request()->filtro_busca == 'data') style="display:none;" @endif>
                        <input type="text" class="form-control busca" autocomplete="off" name="busca_nusp" value="{{ Request()->busca_nusp }}" placeholder="Digite o número USP">
                    </div>
                    <div class="col-sm form-group" id="busca_data" @if(Request()->filtro_busca == 'numero_usp' or Request()->filtro_busca == '') style="display:none;" @endif>
                        <input class="form-control data datepicker" autocomplete="off" name="busca_data" value="{{ Request()->busca_data }}" placeholder="Selecione a data">
                    </div>
                    <div class=" col-auto form-group">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <theader>
            <tr>
                <th>Nº USP</th>
                <th>Nome</th>
                <th>Data</th>
                <th>Horário</th>
                <th colspan="2">Ações</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ $agendamento->codpes }}</td>
                <td><a href="/agendamentos/{{$agendamento->id}}">{{ $agendamento->nome }}</a></td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($agendamento->data_horario)->format('H:i')}}</td>
                <td>
                    <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar</a>
                </td>
                <td>
                    <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $agendamentos->appends(request()->query())->links() }}
@endsection('content')
