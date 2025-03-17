@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<div class="row">
  <div class="col">
      <b>Defesas aprovadas</b><hr/>
    </div>
    <div class="col-md-2" style="padding-bottom:5px; padding-right:12px;">
    <b style="margin-left:1rem;">Filtrar por Ano</b>
    <form method="get" action="/comunicacao" id="form">
      <div class="row">
        <div class="col">
          <select name="filtro_ano" class="form-control" style="margin-left:20px;">
            @foreach(\App\Models\Agendamento::retornarAnoPublicacao() as $ano)
            <option value="{{$ano->data_publicacao}}" {{Request()->filtro_ano == $ano->data_publicacao ? 'selected' : ''}} >{{$ano->data_publicacao ?? 'Selecionar'}}</option>
            @endforeach
          </select>
        </div>
        <div class="col">
          <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>
@if(!request()->filtro_ano)
  <div class="alert alert-info" role="alert">
    <b>Atenção:</b> Para visualizar as defesas aprovadas de um ano específico, selecione o ano desejado no campo acima.
  </div>
  @endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Orientador</th>
      <th scope="col">Data da publicação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($agendamentos as $agendamento)
    <tr>
        <td>{{$agendamento->titulo ?? ''}}
          <td>
            <a href="/comunicacao/{{$agendamento->id}}">
            <div>
                {{$agendamento->nome ?? ''}}
              </div>
            </a>
          </td>
          <td> {{$agendamento->docente->nome ?? ''}} </td>
        <td> {{date('d/m/Y', strtotime($agendamento->data_publicacao)) ?? ''}} </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $agendamentos->appends(request()->query())->links() }}


<script>
      document.addEventListener('DOMContentLoaded', function () {
        let select = document.querySelector('select[name="filtro_ano"]');
        function validaCampo(){
          if(select.value == ''){
            select.classList.add('blinking-border');
          }else{
            select.classList.remove('blinking-border');
          }
        }
        validaCampo();
        select.addEventListener('change', validaCampo);
      });
</script>

<style>
    @keyframes piscar {
    0% { border-color: rgba(255, 0, 0, 1); }
    50% { border-color: rgba(255, 0, 0, 0.3); }
    100% { border-color: rgba(255, 0, 0, 1); }
}

.blinking-border {
    animation: piscar 1s infinite;
}
</style>
@endsection