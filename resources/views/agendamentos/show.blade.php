@extends('laravel-usp-theme::master')

@section('content')
    @inject('pessoa','Uspdev\Replicado\Pessoa')
    @inject('replicado','App\Utils\ReplicadoUtils')
    @can('admin')
    <div class="row">
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
    <br>
    @include('agendamentos.partials.defesa')
    <br>
    @include('agendamentos.partials.banca')
    <br>
    @can('admin') @include('agendamentos.partials.documentos') @endcan
    <br> 
    @can('admin') @include('agendamentos.partials.recibos') @endcan
@endsection('content')
