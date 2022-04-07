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
        <h1 align="center"> STATEMENT OF PARTICIPATION </h1>
        <br><br><br>

        <p class="recuo justificar" style="line-height: 190%;">
            {!! App\Models\Config::setConfigStatement($agendamento,$bancas,$professor)->statement !!}
        </p><br>

        <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
            @foreach($bancas as $banca)    
            <tr style="border='0'">
                <td><b>{{$agendamento->dadosProfessor($banca->codpes)->nome ?? 'Professor não cadastrado'}}</b> </td> 
                <td><b>{{$agendamento->dadosProfessor($banca->codpes)->lotado ?? ' '}}</b></td>           
            </tr>
            @endforeach
        </table>
        <br>
        <div align="right">
            Graduate Studies Services of University of São Paulo, {{Carbon\Carbon::parse($agendamento->data_horario)->format('F jS\, Y')}}    
        </div>
        <p class="page-break"></p> 
    @endforeach
@endsection('content')

@section('footer')
    {!! $configs->footer !!}
@endsection('footer') 