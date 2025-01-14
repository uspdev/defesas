@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('replicado','App\Utils\ReplicadoUtils')

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
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:0.5cm;
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
        <div align="right">
            @php(setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese'))
            São Paulo, {{ strftime('%d de %B de %Y', strtotime($agendamento->data_horario)) }}        
        </div><br>

        <h1 align="center"> DECLARAÇÃO </h1>
        <br><br>

        <p class="recuo justificar" style="line-height: 190%;">
            {!! App\Models\Config::setConfigDeclaracao($agendamento,$bancas,$professor)->declaracao !!}
        </p><br>

        @foreach($bancas as $banca)    
        <div class="col">
            <b>{{$agendamento->dadosProfessor($banca->codpes)['nompes']}}</b> 
            <b>{{$agendamento->dadosProfessor($banca->codpes)['sglclgund']}}</b>
        </div>
            @endforeach
        <div style="margin-top:2cm;" align="center"> 
            Atenciosamente,<br><br><br>
            _____________________________________________________________ <br>  
            <b>
                {{Auth::user()->name}} @if($pessoa::cracha(Auth::user()->codpes)) - Defesas de Mestrado e Doutorado da {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif 
            </b>
        </div>
        <p class="page-break"></p> 
    @endforeach
@endsection('content')

@section('footer')
    {!! $configs->rodape_oficios !!}
@endsection('footer') 
