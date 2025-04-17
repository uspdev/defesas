@inject('pessoa','Uspdev\Replicado\Pessoa')

@extends('pdfs.fflch')
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
    @foreach($professores as $professor)
        <p>
            <div align="right">
                @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
                São Paulo, {{ strftime('%d de %B de %Y', strtotime('today')) }}
            </div><br>

            <div class="moremargin">Assunto: Banca Examinadora de <b>{{ $agendamento->nivpgm }}</b></div>
            <div class="moremargin">Candidato(a): <b>{{ $agendamento->nome }}</b> </div>
            <div class="moremargin">Área: <b>{{ $agendamento->area['nomare'] }}</b> </div>
            <div class="moremargin">Orientador(a) Prof(a). Dr(a). {{ $agendamento->orientador['nompesttd'] }}</div>
            <div class="moremargin">Título do Trabalho: <i>{{ $agendamento->trabalho['tittrb'] }} </i></div>
            <div class="importante" align="center">
                {!! $configs->importante_oficio !!}
            </div>
            <div>
                <i>Data e hora da defesa:  </i> <b> {{date('d/m/Y', strtotime($agendamento->data_horario))}}, às {{date('H:i', strtotime($agendamento->data_horario))}} </b> <br>
                <i>Local:</i> <b> {{$agendamento->sala}} </b>
            </div>
            <i>Composição da banca examinadora:</i>

                @foreach($bancas as $banca)
                <div class="col">
                    {{ $banca['nompesttd'] }}
                    <b>{{ $banca['setor']['sglclgund'] }} {{ ($banca['tipvin'] == 'SERVIDOR') ? ' - USP' : ''}}</b>
                </div>
                @endforeach
            <div class="importante" align="center">
                {!! $configs->regimento !!}
            </div>
            <div align="center">
                Atenciosamente,
                <br> <b>
                    {{Auth::user()->name}} @if($pessoa::cracha(Auth::user()->codpes)) - Defesas de Mestrado e Doutorado da {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif
                </b>
            </div><br>
            Ilmo(a). Sr(a). {{ $professor['nompesttd'] }}<br>
            @if ( $professor['tipvin'] == 'SERVIDOR' )
              Depto. de {{ $professor['setor']['nomset'] }}<br />
            @else
              {{ $professor['nomtiplgr'] . ' ' . $professor['epflgr'] . ' ' .  $professor['numlgr'] . ' ' . $professor['cpllgr'] }}, {{ $professor['nombro'] }} <br>
            @endif
            CEP: {{ $professor['codendptl'] }} - {{ $professor['cidloc'] }}/{{ $professor['sglest'] }}
            <br> telefone: {{ implode(' / ', $professor['telefones']) }}
            <br>e-mail: {{ $professor['email'] }}
        </p>
        <p class="page-break"></p>
    @endforeach
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer')
