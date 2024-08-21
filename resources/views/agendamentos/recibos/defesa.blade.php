@extends('laravel-usp-theme::master')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{--<form method="post" action="agendamentos/sala_virtual/1">
                @method('put')
                @csrf
                <button type="submit" value="1" name="enviar_email" class="btn btn-success">Mandar Solicitação de envio do link</button>
            </form>--}}

            <form method="get" action="">
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-md-4" style="margin-right:-25px;">
                        <select name="tipo" class="form-control" style="width:100%;">
                            <option value="" name="">- Selecionar o tipo da defesa -</option>
                            @foreach($tipoDefesa::tipoSalaVirtual() as $tipo)
                            <option value="{{$tipo}}" name="tipo"
                            @if($tipo == Request()->tipo) selected @endif>
                            {{$tipo}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">Procurar</button>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-header">
                    <b>Agendamentos VIRTUAIS ou HÍBRIDOS sem Link da sala virtual</b>
                </div>
                @forelse($agendamentosTipo as $agendamento)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><b>Titulo: </b>{{$agendamento->titulo}}</h4>
                            <p><b>Aluno: </b>{{$agendamento->nome}}</p>
                            <p><b>Nº USP do aluno: </b>{{$agendamento->codpes}}</p>
                            <p><b>Nível: </b>{{$agendamento->nivel}}</p>
                            <p><b>Resumo: </b>{{$agendamento->resumo}}</p>
                            <p><b>Nome Orientador: </b>{{$agendamento->nome_doc}} - <b>Nº USP: </b>{{$agendamento->orientador}}</p>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Tipo: </b>{{$agendamento->tipo}}</h4>
                            <p><b>Sala Virtual: </b>{{$agendamento->sala_virtual ?? 'Não encontrado'}}</p>
                            <p><b>Sala: </b>{{$agendamento->sala ?? 'Não há sala para esta defesa'}}</p>
                            <p><b>Regimento: </b>{{$agendamento->regimento}}</p>
                            @if($agendamento->enviar_email == true)
                            <p><b>Email Enviado:</b> Sim</p>
                            @else
                            <p><b>Email Enviado: </b>Não</p>
                            <p class="text-muted">*Os E-mails são enviados às 0h</p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @empty
                <span class="alert alert-info">Não foram encontrados registros</span>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection