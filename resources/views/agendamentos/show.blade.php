@extends('laravel-usp-theme::master')

@section('content')
  @inject('pessoa','Uspdev\Replicado\Pessoa')
  @inject('replicado','App\Utils\ReplicadoUtils')
  @include('flash')
  @can('admin')
  <div class="row" style="margin-bottom: 0.5em;">
    <div class="col-sm">
      <a href="/agendamentos/create" class="btn btn-success">Agendar Nova Defesa</a></br>
    </div>
    <div class="col-sm ">
      <div class="row float-right">
        <div class="col-auto">
          <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning">Editar Defesa</a>
        </div>
        <div class="col-auto">
          <form method="POST" action="/agendamentos/{{ $agendamento->id }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endcan
  @include('agendamentos.partials.defesa')
  @include('agendamentos.partials.janus')
  @include('agendamentos.partials.banca')
  @can('biblioteca') @include('agendamentos.partials.files') @endcan
  @can('biblioteca')
    @if($agendamento->files->count() > 0)
      @include('agendamentos.partials.biblioteca')
    @endif
  @endcan
  @can('admin') @include('agendamentos.partials.documentos') @endcan
  @can('admin') @include('agendamentos.partials.recibos') @endcan
@endsection('content')

@section('javascripts_bottom')
<script type="text/javascript">
  $(document).ready(function() {

    $("#buscar").on("click", function(e) {
      e.preventDefault();
      $.ajax({
        url: "/emails/banca/{{ $agendamento->id }}",
        method: "GET",
        dataType: 'json',
        beforeSend: function() {
          $("#email").removeClass("d-block");
          $("#busca").addClass("d-block");
        },
        success: function(data) {
          $("#titulares").html(data.titulares);
          $("#suplentes").html(data.suplentes);
        },
        complete: function() {
          $("#email").addClass("d-block");
          $("#busca").addClass("d-none").removeClass("d-block");
        }
      });
    });

    $(".btn-sm").on("click", function(e) {
      let name = $(this).attr("name");
      getValues(name);
      $(this).html("Copiado!");
      setTimeout(function() {
        $("[name=" + name + "]").html("Copiar");
      }, 2000);

    });

    function getValues(name) {
      let emails = $("#" + name).html();
      navigator.clipboard.writeText(emails);
    }

  });
</script>
@endsection('javascripts_bottom')

