@extends('laravel-usp-theme::master')
@section("content")
@include('flash')
<div class="row">
  <div class="col">
    <b>Defesas defendidas nos últimos três meses</b><hr/>
  </div>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    @foreach($defesas as $defesa)
    <tr>
      <td>
        <a href="/comunicacao/{{ $defesa['id'] }}">
          {!! $defesa['titulo']['tittrb'] !!}
        </a>
        <td>
          {{ $defesa['nome'] }}
        </td>
      <td>{{ $defesa['data_horario'] }}</td>
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
