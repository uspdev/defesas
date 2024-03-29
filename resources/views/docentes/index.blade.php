@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @include('flash')
    <div class="row" style="margin-bottom:0.5em">
        <div class="col-sm">
            <a href="/docentes/create" class="btn btn-primary">Cadastrar Docente</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/docentes">
                <div class="row">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><b>Filtros:</b></label>
                    </div>                
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="padding-bottom: 1em;">
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="todos" value="todos" autocomplete="off" @if(Request()->filtro_busca == 'todos' or Request()->filtro_busca == '') checked @endif> Todos
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="docente_usp" value="docente_usp" autocomplete="off" @if(Request()->filtro_busca == 'docente_usp') checked @endif> Docente USP
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="filtro_busca" id="docente_ext" value="docente_ext" autocomplete="off" @if(Request()->filtro_busca == 'docente_ext') checked @endif> Docente Externo
                        </label>
                    </div>
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o nome completo ou parte dele, número USP, RG ou CPF para buscar professor(a)">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped" style="text-align:center">
        <theader>
            <tr>
                <th>Nº USP</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th colspan="2">Ações</th>
                <th>Última alteração</th>
            </tr>
        </theader>
        <tbody>
        @foreach ($docentes as $docente)
            <tr>
                <td>{{ $docente->n_usp }}</td>
                <td><a href="/docentes/{{$docente->id}}">{{ $docente->nome }}</a></td>
                <td>
                    @if($docente->docente_usp == 'sim')
                        Docente USP
                    @else
                        Docente Externo
                    @endif
                </td>
                <td>
                    <a href="/docentes/{{$docente->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                </td>
                <td>
                    <form method="POST" action="/docentes/{{ $docente->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                <td>
                    @if($pessoa::dump($docente->last_user))por: {{$pessoa::dump($docente->last_user)['nompes']}} em: {{Carbon\Carbon::parse($docente->updated_at)->format('d/m/Y')}}@endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $docentes->appends(request()->query())->links() }}
@endsection('content')
