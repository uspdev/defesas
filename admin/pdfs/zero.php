<?php

header("Content-type: text/html;charset=utf-8");
require('../../config.php');
$user = new Users;
$docente = new Docente;
$obj_candidato =  new Candidato;
$status = $user->verificarStatus();
$configdocs = new ConfigDocs;
$info_banco = $configdocs->ver();

if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');
include('./loadCandidato.php');
include_once("../../libraries/dompdf6/dompdf_config.inc.php");
if(isset($html_to_PDF)) unset($html_to_PDF); 

$html_to_PDF = '<html> <head> <style type="text/css">
body {margin:0px; padding:0px;}
.negrito {font-weight: bolder;}
.justificar{text-align: justify;}
.etiqueta{font-size: 14px;}
p {line-height:70%}


</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';


$html_to_PDF .= "<b> <table width=\"18cm\">
									<tr>
										<td width=\"9cm\" > Nome: {$candidato['nome']} </td>
										<td> Data da Defesa: {$candidato['data_defesa']} </td>
									</tr>
									<tr>
										<td> {$candidato['nivel']}: {$candidato['nome_area']} </td>
										<td> Hora: {$candidato['horario_defesa']} </td>
									</tr>
									<tr>
										<td> N° USP: {$candidato['codpes']}  </td>
										<td> Sala: {$candidato['nome_sala']} </td>
									</tr>
</b> </table>";



$html_to_PDF .= "

<hr> <b>
<table>
	<tr> 
		<td> 2 PRÉ-RELATÓRIOS	</td> 
		<td> 	(&nbsp;&nbsp;) </td> 
	</tr>
	<tr> 
		<td>ENVIO  ___/____		</td> 
		<td> 	(&nbsp;&nbsp;)	</td> 
	</tr>
	<tr> 
		<td>  COMUNICADO 		</td> 
		<td> 	(&nbsp;&nbsp;)	</td> 
	</tr>
	<tr> 
		<td>  PAGAMENTO </td> 
		<td> 	(&nbsp;&nbsp; )	</td> 
	</tr>
</table>

<hr>
<p> <u> PASSAGENS, HOTEL E DIÁRIAS: <u> </b> </p>  ";

$miolo = "
<p> Prof. _______________________________________________________________________________ </p>
<p>PASSAGEM:_________/SP (_______)/__________ Ida: ____/____ Hora: ___________ </p>
<p>Obs._____________________________________________. Volta: ____/____ Hora: ____________ </p>
<p>Cotação: _____/_____ Compra:_____/_____ </p>
<p>HOTEL: _____________ Pedido de Reserva em: _____/_____ - Reserva ok ( ) </p>
<p>DIÁRIAS: ½ ( ) 1 ( ) 2 ( )          Pedido ok ( ) </p>
<p>Almoço: Sim (   )     Não (   ) pedido ok (  ) </p>
<p>E-mail enviado? Sim (  ) Não (   ) </p> 
<hr>"
;

$html_to_PDF .= $miolo;
$html_to_PDF .= $miolo;
$html_to_PDF .= $miolo;


$html_to_PDF .= "
<b>
<table width=\"18cm\">
	<tr> 
		<td width=\"9cm\"> Banca marcada em: _____/_____ 	</td> 
		<td> 	Todos os dados ok. (  )	</td> 
	</tr>
</table>
</b>";

$html_to_PDF .= '</body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("zero.pdf");

?>






