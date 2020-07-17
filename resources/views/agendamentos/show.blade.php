@extends('laravel-usp-theme::master')

@section('content')

<div class="row">
    <div class="col-sm">
        <a href="/agendamentos/create" class="btn btn-primary">Agendar Nova Defesa</a></br>
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
<br>

@inject('pessoa','Uspdev\Replicado\Pessoa')

<div class="card">
    <div class="card-header">Defesa</div>
    <div class="card-body">
        <b>Título da Tese:</b> {{$agendamento->titulo}}</br>
        <b>Candidato:</b> {{$pessoa::dump($agendamento->codpes)['nompes'] }} </br>
        <b>Nº USP:</b> {{ $agendamento->codpes }}</br>
        <b>Sexo:</b> {{$agendamento->sexo}}</br>
        <b>Regimento:</b> {{$agendamento->regimento}}</br>
        <b>Nível:</b> {{$agendamento->nivel}}</br>
        @foreach ($agendamento->programaOptions() as $option)
            @if ($option == $agendamento->area_programa)
                <b>Programa:</b> {{$option}}</br>
            @endif
        @endforeach
        <b>Orientador Votante:</b> {{$agendamento->orientador_votante}}</br>
        <b>Orientador:</b> {{$pessoa::dump($agendamento->orientador)['nompes']}}</br>
        <b>Data:</b> {{$agendamento->data}}</br>
        <b>Horário:</b> {{$agendamento->horario}}</br>
        @foreach ($agendamento->salaOptions() as $option)
            @if ($option == $agendamento->sala)
                <b>Local:</b> {{$option}}</br>
            @endif
        @endforeach
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">Banca</div>
    <div class="card-body">
        <a href="/agendamentos/{{ $agendamento->id }}/bancas/create" class="btn btn-success">Inserir Professor</a>
        <br>
        <br>
        <table class="table table-striped">
            <theader>
                <tr>
                    <th>Nº USP</th>
                    <th>Nome</th>
                    <th>Presidente</th>
                    <th colspan="2">Ações</th>
                </tr>
            </theader>
            <tbody>
            @foreach ($agendamento->bancas as $banca)
                <tr>
                    <td>{{ $banca->codpes }}</td>
                    <td><a href="/agendamentos/{{$agendamento->id}}">{{ $pessoa::dump($banca->codpes)['nompes'] }}</a></td>
                    <td>{{ $banca->presidente }}</td>
                    <td>
                        <a href="/agendamentos/{{$agendamento->id}}/bancas/{{$banca->id}}/edit" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <form method="POST" action="/agendamentos/{{ $agendamento->id }}/bancas/{{$banca->id}}">
                            @csrf 
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">Documentos Gerais</div>
    <div class="card-body">

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        Documento Zero
                    </td>
                    <td>
                        <a href="/documento_zero/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                   
                <tr>
                    <td>
                        Placa
                    </td>
                    <td>
                        <a href="/placa/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Etiquetas
                    </td>
                    <td>
                        <a href="/etiqueta/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ofício titulares
                    </td>
                    <td>
                        <a href="/titulares/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ofício suplentes
                    </td>
                    <td>
                        <a href="/suplentes/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Declaração de Participação
                    </td>
                    <td>
                        <a href="/declaracao/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Recibos de remessa de documentos para docentes USP                    
                    </td>
                    <td>
                        <a href="/recibos/{{$agendamento->id}}" class="btn btn-info"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection('content')
