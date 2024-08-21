@extends('laravel-usp-theme::master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Informações do agendamento</b>
                    </div>
                    <div class="card-body">
                        <b>Titulo: </b> {{$agendamento->titulo}}<br />
                        <b>Autor: </b> {{$agendamento->nome}}<br />
                        <b>Orientador: </b>{{$agendamento->nome_doc}} - {{$agendamento->orientador}}<br />
                        <b>Nível: </b> {{$agendamento->nivel}}<br/>
                        <b>Área do Programa: </b> {{$agendamento->area_programa}}<br />
                        <b>Resumo: </b> {{$agendamento->resumo}}<br />
                            @if($agendamento->url != null)
                        <b>URL: </b><a href="{{$agendamento->url}}">{{$agendamento->url}}</a>
                        <br />@endif
                            @if($agendamento->data_publicacao != null)
                        <b>Data de Publicação: </b> {{ date('d/m/Y', strtotime($agendamento->data_publicacao))}}
                        <br />@endif

                        <hr>

                    <div class="row">
                        <div class="col-md-2">
                        <b>STATUS DA PUBLICAÇÃO:</b>
                        @if($agendamento->status !== null && $agendamento->status == 1)
                            <h3 class="text-success">Publicado</h3>
                        @elseif($agendamento->status !== null && $agendamento->status == 0)
                            <h3 class="text-danger">Não publicado</h3>
                        @else
                            <h3 class="text-warning">Em análise.</h3>
                        @endif

                        @if($agendamento->approval_status == 'Aprovado') <!-- btn só aparece neste caso -->
                        <!-- botões -->
                        @if($agendamento->status == 0 && $agendamento->status !== null)
                            <form method="post" action="/status/aprovar/{{$agendamento->id}}">
                                @csrf
                                @method("put")
                                <button value="1" class="btn btn-success">Publicar</button>
                            </form>
                            @elseif($agendamento->status == 1 && $agendamento->status !== null)
                            <form method="post" action="/status/reprovar/{{$agendamento->id}}">
                                @csrf
                                @method("put")
                                <button value="0" name="status" class="btn btn-danger">Remover publicação</button>
                            </form>
                            @else
                                <form method="post" name="status" action="/status/aprovar/{{$agendamento->id}}">
                                    @csrf
                                    @method("put")
                                    <button value="1" name="status" class="btn btn-success" style="margin-right:5px;">Publicar</button>
                                </form>
                        @endif
                        @else

                        @endif
                        </div>
                        <div class="vertical-line"></div>
                        <div class="col-md-6">
                            <b>STATUS DE APROVAÇÃO:</b>
                            @if($agendamento->approval_status == 'Aprovado')
                                <h3 class="text-success">Aprovado</h3>
                            @elseif($agendamento->approval_status !== null && $agendamento->approval_status == 'Reprovado')
                                <h3 class="text-danger">Reprovado</h3>
                            @else
                                <h3 class="text-warning">Em análise</h3>
                            @endif
                                <a href="/agendamentos/{{$agendamento->id}}" class="btn btn-primary">Ver informações detalhadas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<style>
    .vertical-line{
        width:1px; height:6rem; background-color:rgb(0,0,0,.1); margin-right:2%; margin-left:-2%;
    }

    @media(max-width:766px){
        .vertical-line{
            height:1px;
            width:100%;
            margin-top:5px;
        }    
    }
</style>