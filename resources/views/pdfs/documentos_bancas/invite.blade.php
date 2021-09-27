@extends('pdfs.fflch')
@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('replicado','App\Utils\ReplicadoUtils')

@section('styles_head')
<style type="text/css">
    #headerFFLCH {
        font-size: 14px; width: 17cm; text-align:center; font-weight:bold;
    }
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
        text-indent: 0.5cm;
    }
    .moremargin {
        margin-bottom: 0.15cm;
    }
    .importante {
        border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:1.5cm;
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
    #footer {
        position: fixed;
        bottom: -1cm;
        left: 0px;
        right: 0px;
        text-align: center;
        border-top: 1px solid gray;
        width: 18.5cm;
        height: 100px;
    }
    .page-break {
        page-break-after: always;
        margin-top:160px;
    }
</style>
@endsection('styles_head')

@section('header')
  <table style='width:100%'>
    <tr>
      <td style='width:20%' style='text-align:left;'>
        <img src='images/logo-fflch.png' width='100px'/>
      </td>
      <td style='width:80%'; style='text-align:center;'>
        <p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
        <br>University of São Paulo<br>
        Graduate Service</p>
      </td>
    </tr>
  </table>
  </br>
@endsection('header')

@section('content')

    <div align="right">
        São Paulo, {{date('F jS\, Y')}}
    </div><br><br>

    <div class="moremargin">Subject: @if($agendamento->nivel == 'Mestrado') <b>Master's</b> @else <b>Doctorate's</b> @endif Examination Committee</div> 
    <div class="moremargin">Candidate: <b>{{$agendamento->nome}}</b> </div>
    <div class="moremargin">Area: <b>{{$replicado->nomeAreaProgramaEmIngles($agendamento->area_programa)}}</b> </div>
    <div class="moremargin">Supervisor: {{$pessoa::dump($agendamento->orientador)['nompes']}}</div>
    <div class="moremargin">Title of the thesis: <i>{{$agendamento->titulo}} </i></div><br>
    <div class="importante">
        {!! $configs->important !!}
    </div><br>
    <p>
        <i>Defense's date and time:  </i> <b> {{Carbon\Carbon::parse($agendamento->data_horario)->format('F jS\, Y \a\t g a')}} (Brasília's Time)</b> <br> 
        <i>Place:</i> <b> {{$agendamento->sala}} </b> - FFLCH Administration 
    </p>  
    <i>Composition of the examination committee:</i> 


    <table width="16cm" style="border='0'; margin-left:4cm; align-items: center; justify-content: center;">
        @foreach($professores as $componente)    
        <tr style="border='0'">
            <td> {{$agendamento->dadosProfessor($componente->codpes)->nome ?? 'Professor não cadastrado'}} </td> 
            <td><b>{{$agendamento->dadosProfessor($componente->codpes)->lotado ?? ' '}}</b></td>
        </tr>
        @endforeach
    </table>

    <br>
	<div class="importante" align="center"> 
        {!! $configs->regiment !!}
    </div>

    <p align="center">
        Sincerely, 
		<br>
        <b> 
            {{Auth::user()->name}} @if($pessoa::cracha(Auth::user()->codpes)) - Defenses of Master and Doctorate {{$pessoa::cracha(Auth::user()->codpes)['nomorg']}}/USP @endif 
		</b>
    </p>
    <br><br>
    {{$agendamento->dadosProfessor($professor->codpes)['nome'] ?? 'Professor não cadastrado'}}<br>
    {{$agendamento->dadosProfessor($professor->codpes)->endereco ?? ' '}}, {{$agendamento->dadosProfessor($professor->codpes)->bairro ?? ' '}} <br>
    Post Code:{{$agendamento->dadosProfessor($professor->codpes)->cep ?? ' '}} - {{$agendamento->dadosProfessor($professor->codpes)->cidade ?? ' '}}/{{$agendamento->dadosProfessor($professor->codpes)->estado ?? ' '}}
    <br> Phone: {{$agendamento->dadosProfessor($professor->codpes)->telefone ?? ' '}}
    <br>Email: {{$agendamento->dadosProfessor($professor->codpes)->email ?? ' '}}
    <div id="footer">
        {!! $configs->footer !!}
    </div>

@endsection('content')
