@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('replicado','App\Utils\ReplicadoUtils')

    <div class="row">
        <div class="col-sm">
            <a href="/docentes/create" class="btn btn-success">Cadastrar Docente</a></br>
        </div>
        <div class="col-sm ">
            <div class="row float-right">
                <div class="col-auto">
                    <a href="/docentes/{{$docente->id}}/edit" class="btn btn-warning">Editar Docente</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="/docentes/{{ $docente->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Docente</b></div>
        <div class="card-body">
            <b>Nome Completo:</b> {{$docente->nome}}</br>
            <b>Nº USP:</b> {{ $docente->n_usp }}</br>
            <b>CPF:</b> {{$docente->cpf}}</br>
            <b>
                @foreach ($docente->documentoOptions() as $option)
                    @if ($option == $docente->tipo)
                        {{$option}} :
                    @endif
                @endforeach
            </b> {{$docente->documento}}</br>
            <b>Endereço:</b> {{$docente->endereco}}</br>
            <b>Bairro:</b> {{$docente->bairro}}</br>
            <b>CEP:</b> {{$docente->cep}}</br>
            <b>Cidade:</b> {{$docente->cidade}}</br>
            <b>Estado:</b> {{$docente->estado}}</br>
            <b>País:</b> {{$docente->pais}}</br>
            <b>PIS/PASEP:</b> {{$docente->pis_pasep}}</br>
            <b>Banco:</b> {{$docente->banco}}</br>
            <b>Agência:</b> {{$docente->agencia}}</br>
            <b>Conta Corrente:</b> {{$docente->c_corrente}}</br>
            <b>Telefones:</b> {{$docente->telefone}}</br>
            <b>Nome e sigla da Universidade na qual tem vínculo profissional:</b> {{$docente->lotado}}</br>
            <b>E-mail:</b> {{$docente->email}}</br>
            <b>Status:</b>
            @foreach ($docente->statusOptions() as $option)
                @if ($option == $docente->status)
                    {{$option}}</br>
                @endif
            @endforeach
            <b>Docente USP?:</b>
            @foreach ($docente->docenteUspOptions() as $option)
                @if ($option == $docente->docente_usp)
                    {{$option}}</br>
                @endif
            @endforeach
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Bancas que participou como Orientador(a)</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Candidato</th>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Programa/Área</th>
                    <th>Nível</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docente->getBancasProfessor($docente->n_usp,'Orientador') as $banca)
                    <tr>
                        <td><a href="/agendamentos/{{$banca->id}}">{{$banca->nome}}</a></td>
                        <td>{{$banca->titulo}}</td>
                        <td>{{Carbon\Carbon::parse($banca->data_horario)->format('d/m/Y')}}</td>
                        <td>{{$replicado::nomeAreaPrograma($banca->area_programa)}}</td>
                        <td>{{$banca->nivel}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="card">
        <div class="card-header"><b>Bancas de defesa que participou como Examinador(a)</b></div>
        <table class="table table-striped" style="text-align:center;">
            <thead class="thead-light">
                <tr>
                    <th>Candidato</th>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Programa/Área</th>
                    <th>Nível</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docente->getBancasProfessor($docente->n_usp,'Examinador') as $bancas)
                    @foreach($bancas as $banca)
                    <tr>
                        <td><a href="/agendamentos/{{$banca['id']}}">{{$banca['nome']}}</a></td>
                        <td>{{$banca['titulo']}}</td>
                        <td>{{Carbon\Carbon::parse($banca['data_horario'])->format('d/m/Y')}}</td>
                        <td>{{$replicado::nomeAreaPrograma($banca['area_programa'])}}</td>
                        <td>{{$banca['nivel']}}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
@endsection('content')
