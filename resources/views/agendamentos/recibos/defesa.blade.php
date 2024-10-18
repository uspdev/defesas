@extends('laravel-usp-theme::master')
@section('content')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="get" action="/pendencia_sala_virtual">
        @csrf
          <div class="row" style="margin-bottom:10px;">
            <div class="col-md-6" style="margin-right:-20px;">
              <input type="text" value="{{request()->busca}}" name="busca" class="form-control" placeholder="Procurar por Nº USP">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success">Procurar</button>
            </div>
          </div>
      </form>

      <div class="card">
        <div class="card-header">
          <b>Agendamentos virtuais sem o link da sala virtual</b>
        </div>
        @forelse($agendamentos as $agendamento)
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <h4><b>Titulo: </b>{{$agendamento->titulo}}</h4>
              <p><b>Aluno: </b>{{ $agendamento->nome }}</p>
              <p><b>Nº USP do aluno: </b>{{ $agendamento->codpes }}</p>
              <p><b>Nível: </b>{{ $agendamento->nivel }}</p>
              <p><b>Resumo: </b>{{ $agendamento->resumo }}</p>
              <p><b>Nome do orientador: </b>{{ $agendamento->docente->nome ?? '' }} - <b>Nº USP: </b>{{ $agendamento->orientador }}</p>
              <p><b>Data da defesa:</b> {{ date('d/m/Y',strtotime($agendamento->data_horario))}}</p>
            </div>
            <div class="col-md-4">
              <h4><b>Tipo: </b>{{$agendamento->tipo}}</h4>
              <p><b>Sala Virtual: </b>{{ $agendamento->sala_virtual ?? 'Pendente' }}</p>
              <p><b>Sala: </b>{{ $agendamento->sala ?? 'Não há sala para esta defesa' }}</p>
              <p><b>Regimento: </b>{{ $agendamento->regimento }}</p>
              @if($agendamento->enviar_email == true)
                <p><b>Email Enviado:</b> Sim</p>
              @else
                <p><b>Email Enviado: </b>Não</p>
                <p class="text-muted">*Os E-mails são enviados às 0h</p>
              @endif
              <a href="/agendamentos/{{$agendamento->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
            </div>
          </div>
        </div>
        <hr>
        @empty
          <span class="alert alert-info">Não foram encontrados registros</span>
        @endforelse
      </div>
    </div>
  </div>
</div>

@endsection
