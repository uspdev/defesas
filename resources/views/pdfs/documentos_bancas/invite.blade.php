@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('laravel-fflch-pdf::main')
@section('other_styles')
<style type="text/css">
    .data_hoje{
        margin-left: 10cm; margin-bottom:0.8cm;
    }
    .conteudo{
        margin: 1cm
    }
    .boxSuplente {
        border: 1px solid; padding: 4px;
    }
    .boxPassagem {
        border: 1px solid; padding: 4px; text-align: justify;
    }
    .oficioSuplente{
        text-align: justify;
    }
    .rodapeFFLCH{
        padding-top:3cm; text-align: center;
    }
    p.recuo {
        text-indent: 0.5em;
        direction: rtl;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:4em;
    }
    .negrito {
        font-weight: bolder;
    }
    .justificar{
        text-align: justify;
    }
    table{
        border-collapse: collapse;
        border: 0px solid #000;
    }
    table th, table td {
        border: 0px solid #000;
    }
    tr, td {
        border: 1px #000 solid; padding: 1
    }
    body{
        margin-top: 0.2em; margin-left: 1.8em; font-family: DejaVu Sans, sans-serif; font-size: 12px;
    }
    #footer{
        text-align:center;
    }
</style>
@endsection('other_styles')

@section('content')
  <div align="right">
    São Paulo, {{date('F jS\, Y')}}
  </div><br>
  <div class="moremargin">Subject: @if($agendamento['nivel'] == 'Mestrado') <b>Master's</b> @else <b>Doctorate's</b> @endif Examination Committee</div>
  <div class="moremargin">Candidate: <b>{{ $agendamento->aluno }}</b> </div>
  <div class="moremargin">Area: <b>{{ $agendamento->area['nomareigl'] ?? $agendamento->area['nomare'] }}</b> </div>
  <div class="moremargin">Supervisor: {{ $agendamento->orientador['nompesttd'] }}</div>
  <div class="moremargin">Title of the thesis: <i>{{ $agendamento->trabalho['tittrbigl'] ?? $agendamento->trabalho['tittrb'] }} </i></div>
  <div class="importante">
    {!! $configs->important !!}
  </div>
  <p>
  <i>Defense's date and time:  </i> <b> {{ Carbon\Carbon::parse($agendamento->data_horario)->format('F jS\, Y \a\t g:i a') }} (Brasília's Time)</b><br>
  <i>Place:</i> <b> {{ $agendamento->sala }} </b> - FFLCH Administration
  </p>
  <i>Composition of the examination committee:</i>
    @foreach($professores as $docente)
      <div class="col">
        {{ $docente['nompesttd'] ?? 'Professor não cadastrado' }}
        <b>{{ $docente['setor']['sglclgund'] }} {{ ($docente['tipvin'] == 'SERVIDOR') ? ' - USP' : '' }}</b>
      </div>
    @endforeach
  <div class="importante" align="center">
    {!! $configs->regiment !!}
  </div>
  <p align="center">
    Sincerely,<br>
    <b>
      {{Auth::user()->name}} @if($pessoa::cracha(Auth::user()->codpes)) - Defenses of Master and Doctorate {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif
    </b>
  </p>
  <br>
  {{ $professor['nompesttd'] }}<br>
  @if ( $professor['tipvin'] == 'SERVIDOR' )
    {{ $professor['setor']['nomset'] }}<br />
  @else
    {{ $professor['nomtiplgr'] . ' ' . $professor['epflgr'] . ' ' .  $professor['numlgr'] . ' ' . $professor['cpllgr'] }}, {{ $professor['nombro'] }} <br>
  @endif
  Post Code: {{ $professor['codendptl'] }} - {{ $professor['cidloc'] }}/{{ $professor['sglest'] }}
  <br> Phone: {{ implode(' / ', $professor['telefones']) }}
  <br> Email: {{ $professor['email'] }}
@endsection('content')

@section('footer')
  {!! $configs->footer !!}
@endsection('footer')
