@extends('laravel-usp-theme::master')

@section('javascripts_bottom')
  <script src="{{asset('/js/app.js')}}"></script>
@endsection('javascript_head')

@section('content')
    @include('flash')
    <div class="card">
        <div class="card-body">
          <form method="GET" action="/docentes/search">
              <div class="row">
                  <div class="col-auto">
                      <label style="margin-top:0.35em; margin-bottom:0em;"><b>Buscar por Nome ou N° USP:</b></label>
                  </div>
                  <div class="col-auto">
                    <input type="text" class="form-control" name="search" value="{{ old('search') ?? $search }}">
                  </div>
                  <div class="col-auto">
                      <button type="submit" class="btn btn-success">Buscar</button>
                  </div>
              </div>
          </form>
        </div>
    </div>
    <table class="table table-striped">
      <theader>
        <tr>
          <th>N° USP</th>
          <th>Nome</th>
        </tr>
      </theader>
      <tbody>
        @forelse ($pessoas as $pessoa)
          <tr>
            <td>{{ $pessoa['codpes'] }}</td>
            <td><a href="docentes/{{$pessoa['codpes']}}">{{ $pessoa['nompesttd'] }}</a></td>
          </tr>
        @empty
          <tr>
            <td colspan="2">Nenhum registro encontrado para a pesquisa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
@endsection('content')
