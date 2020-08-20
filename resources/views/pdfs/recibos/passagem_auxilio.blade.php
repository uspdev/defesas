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

    <h3>
        <center>
            UNIVERSIDADE DE SÃO PAULO<br>
			FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS<br>
			SERVIÇO DE COMPRAS
        </center>
    </h3>

	<left> {$info_banco[0]['header_auxilio']} </left> 
	<left> <u><b>{$_POST['processo']}</b></u> </left> <br> 

	<p> Banca de defesa de <b> {$candidato['nome']} </p> 
	<p> Passageiro(a) {$_POST['nome_docente']} </p> 
	<p> Itinerário: {$_POST['itinerario']} </p> 
	<p> Partida: {$_POST['partida']} </p> 
	<p> Retorno: {$_POST['retorno']} </p> 
	<p> Telefone: {$_POST['telefone_docente']} </p> 
	<p> E-mail:  {$_POST['email_docente']} </p> 
	<div class="justificar"> {$info_banco[0]['obs_passagem']} </div>
					
	<p>{$candidato['hoje']}</p>
	<center> 
        <br>
        <p style="margin-top:3cm;">
		    <b> 
			{$usuario[0]['nome']} <br>
			{$usuario[0]['codpes']}
			<br> SPG-FFLCH-USP 
		    </b> 
        </p>
    </center>

    <div id="footer">
      {!! $configs->rodape_oficios !!}
    </div>
    <p style="page-break-before: always">&nbsp;</p>
@endsection('content')
