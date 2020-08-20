@extends('pdfs.fflch')

@section('styles_head')
<style>
    #headerFFLCH { font-size: 15px; width: 17cm; text-align:center;}
    .data_hoje{ margin-left: 10cm; margin-bottom:0.8cm; }
    .conteudo { margin: 1cm }
    p.recuo {text-indent: 0.5cm;}
    .moremargin {margin-bottom: 0.15cm;}
    .importante {border:2px solid; background-color:#cbcbcb; margin-top:0.3cm; margin-bottom:0.3cm;}
    .negrito {font-weight: bolder;}
    .justificar{text-align: justify;}
    table { background #fff; border-collapse: collapse; }
    tr, td { border: 1px #000 solid; padding: 3 }
    #proap { font-family:Courier; font-size:13px; }
</style>
@endsection('styles_head')

@section('header')
  <table style='width:100%'>
    <tr>
      <td style='width:20%' style='text-align:left;'>
        <img src='https://www.fflch.usp.br/themes/contrib/aegan-subtheme/images/logo.png' width='230px'/>
      </td>
      <td style='width:80%'; style='text-align:center;'>
        <p align='center'><b>FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS</b>
        <br>Universidade de São Paulo<br>
        Serviço de Pós-Graduação</p>
      </td>
    </tr>
  </table>
  <hr>
@endsection('header')

@section('content')

    <div class="data_hoje">{$candidato['hoje']}</div>
	<left> {$info_banco[0]['agencia_viagem']} </left> 
	<br> 
    <ul> 
		<li>Requisição passagem aérea nº <b>{$_POST['requisicao']} </b> </li>  
		<li>Programa: <b>{$candidato['nome_area']} </b> </li>  
		<li><b>{$candidato['nivel']} </b> </li>  
		<li>Defesa do Sr.(a): <b> {$candidato['nome']} </b> </li>  
		<li>Orientador(a): Prof(a) Dr(a)<b> {$candidato['orientador']} </b> </li>
    </ul>
	<div class="justificar" style="text-indent:1cm;" >{$info_banco[0]['agencia_texto']} </div>
	<div class="boxPassagem">  
		Interessado(a): Prof(a). Dr(a). <b> {$_POST['nome_docente']}</b> <br>
		E-mail: <b>{$_POST['email_docente']}</b> <br>
		Telefone:<b> {$_POST['telefone_docente']}</b> <br>
		Data da defesa:<b> {$candidato['data_placa']}</b> <br>
		Trajeto da passagem aérea <b> {$_POST['trajeto']}</b> <br>
	</div> <br>
	<table style="width:15.5cm;"> 
		<tr> 
			<td style="width:7.25cm;"> <center> <b>IDA </b></center></td>
			<td> <center><b>VOLTA </b> </center> </td>
		</tr>
		<tr>
			<td> {$_POST['ida']} </td>
			<td> {$_POST['volta']} </td>
		</tr>
	</table> <br>

	<p><b> Solicitamos a gentileza no sentido de comunicar aos professores interessados, com antecedência, n° do PTA e nome da companhia aérea.  </b></p> <br> <br> 
	<center><b> Favor faturar para: {$info_banco[0]['faturar_para']} </b></center> <br>
	<center> 
        <div style="margin-top:2cm;"> 
            Atenciosamente, 
        </div>
        <br><br><br>
        <b> 
		    {$usuario[0]['nome']} 
			<br> Serviço de Pós-Graduação - FFLCH/USP  
		</b>
    </center>

    <div id="footer">
      {!! $configs->rodape_oficios !!}
    </div>
    <p style="page-break-before: always">&nbsp;</p>
@endsection('content')
