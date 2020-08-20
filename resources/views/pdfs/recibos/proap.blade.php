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

    <div id="proap">	
        <center> <span style="font-size:16px;"> <b> RECIBO DE DIÁRIAS - BANCA EXAMINADORA </b> </span> </center>	
        <center> <span style="font-size:14px;"> <b> PROAP {$_POST['ano']} </b> </span> </center>
        <hr>
        <table width="16.5cm" style="border:0px;">
			<tr>
				<td style="border:0px;" colspan="2">Nome do Convidado: {$_POST['nome_docente']} </td>
			</tr>
			<tr>
				<td style="border:0px;"> CPF: {$_POST['cpf_docente']}</td>
				<td style="border:0px;">  RG: {$_POST['documento']}  </td>
			</tr>
		</table>				
	    <hr>
	    <table width="16.5cm" style="border:0px;">
			<tr>
				<td style="border:0px;">Unidade: </td>
				<td style="border:0px;"> {$_POST['lotado']} </td>
				<td style="border:0px;">Cargo: </td>
				<td style="border:0px;"> <b> Professor(a) Doutor(a) </b> </td>
			</tr>
			<tr>
				<td style="border:0px;">Pós Graduação em: </td>
				<td style="border:0px;"> {$candidato['nome_area']} </td>
				<td style="border:0px;"> Mês: </td>
				<td style="border:0px;"> <b> {$candidato['data_mes']}</b> </td>
			</tr>
		</table>			
	    <center>
	    <br> <div style="font-size:16px;">  <b>DISCRIMINAÇÃO</b> </span> </div><br>		
	    <table width="18.5cm" style="border:1px;">
			<tr>
				<td style="border:1px solid;" colspan="2"> <b> CHEGADA NA SEDE</b> </td>
				<td style="border:1px solid;" rowspan="2"> <b> ORIGEM  <b> </td>
				<td style="border:1px solid;" colspan="2"> <b> SAÍDA DA SEDE </td>
				<td style="border:1px solid;" rowspan="2"> <b> N° DIÁRIAS </b> </td>
				<td style="border:1px solid;" rowspan="2"> <b> TOTAL </b> </td>
			</tr>
			<tr>
				<td style="border:1px solid;"> DIA</td>
				<td style="border:1px solid;"> HORA </td>
				<td style="border:1px solid;"> DIA</td>
				<td style="border:1px solid;"> HORA </td>
			</tr>
			<tr>
				<td style="border:1px solid;"> {$_POST['chegada']} </td>
				<td style="border:1px solid;">  </td>
				<td style="border:1px solid;"> {$_POST['origem']}  </td>
				<td style="border:1px solid;"> {$_POST['saida']}  </td>
				<td style="border:1px solid;">  </td>
				<td style="border:1px solid;"> {$_POST['diaria_proap']} </td>
				<td style="border:1px solid;"> {$_POST['valor_proap']}  </td>
			</tr>
			<tr>
				<td style="border:0;" colspan="4">  Valor da Diária com pernoite </td>
				<td style="border:0;"> {$info_banco[0]['diaria_com_pernoite']}   </td>
				<td style="border:1px solid;"> <b> TOTAL </b> </td>
				<td style="border:1px solid;"> <b> {$_POST['valor_proap']}  </b> </td>
			</tr>
		</table>
	    </center>
	    <br><br><br><br><br>Recebi o valor de {$_POST['valor_proap']} ({$_POST['extenso']}) <br><br><br>
	    Referente às diárias a que fiz jus conforme demonstração supra. <br><br><br>
	    São Paulo, {$candidato['data_proex']} <br><br><br><br>
	    <table width="18cm"> 
			<tr>
				<td style="border:0;"> <hr style="width:10cm;"> 
					{$_POST['nome_docente']} <br> 
					<b>{$_POST['endereco']}</b>
				</td>
			</tr> 
		</table>

	    <center> <b> {$_POST['email_docente']} </b> </center>
	    <br> <center> <b>RELATÓRIO </center></b> <br> <div class="justificar">  {$info_banco[0]['capes_proap']} </div> 
	    Banca de: {$candidato['nome']} <br><br><br><br><br><br><br>
        <table width="18cm"> 
			<tr>
				<td style="border:0;"> <hr style="width:10cm;"> 
					<center>Assinatura do(a) Coordenador(a)</center>
				</td>
			</tr> 
		</table>

	</div>

    <div id="footer">
      {!! $configs->rodape_oficios !!}
    </div>
    <p style="page-break-before: always">&nbsp;</p>
@endsection('content')
