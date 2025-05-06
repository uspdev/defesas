@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style>
    body{
        margin-top: 0px; margin-left:3em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    .justificar{text-align: justify; margin-right:2em;}
</style>
@endsection('other_styles')

@section('content')
    <br>
    <left> {!! $configs->header_auxilio !!} </left>
    <left> <u><b>{{ $dados->processo }}</b></u> </left> <br>

    <p> Banca de defesa de <b> {{ $agendamento->aluno }} </p>
    <p> Passageiro(a) {{ $docente['nompesttd'] ?? 'Professor não cadastrado'}} </p>
    <p> Itinerário: {{ $dados->itinerario }} </p>
    <p> Partida: {{ $dados->partida }}</p>
    <p> Retorno: {{ $dados->retorno }} </p>
    <p> Telefones:
      @foreach ($docente['telefones'] as $telefone)
        {{ $telefone }}
      @endforeach
    </p>
    <p> E-mail: {{ $docente['email'] }}
    </p>
    <div class="justificar"> {!! $configs->obs_passagem !!} </div>

    <p>
      @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
      São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
    </p>
    <center>
      <br>
      <p style="margin-top:3cm;">
      <b>
        {{ Auth::user()->name }} <br>
        {{ Auth::user()->codpes }}
        <br> @if($pessoa::cracha(Auth::user()->codpes)) SPG-{{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}-USP @endif
      </b>
      </p>
    </center>
@endsection('content')
