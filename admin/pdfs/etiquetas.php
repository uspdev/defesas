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
body {margin: 1cm -1.2cm 0cm -1.2cm ; padding:0; }
.negrito {font-weight: bolder;}
.justificar{text-align: justify;}
.etiqueta{font-size: 12px; border-spacing:0.5cm 0cm;}
tr {margin-left:0.5cm;}
td {margin-left:0.5cm;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';
/*Formato das etiquetas*/
$orientador_etiqueta = "Ilmo(a) Sr(a). <br> {$orientador['nome']}";
$orientador_etiqueta .=  "<br> {$orientador['endereco']}";
if(isset($orientador['bairro'])) 
	$orientador_etiqueta .=  "<br> {$orientador['bairro']}";
if(isset($orientador['cep'])) 
	$orientador_etiqueta .=  " {$orientador['cep']}";
if(isset($orientador['estado']) && isset($orientador['cidade'])) 
	$orientador_etiqueta .=  "<br> {$orientador['cidade']}-{$orientador['estado']}";

$titular2_etiqueta = "Ilmo(a) Sr(a). <br> {$titular2['nome']}";
$titular2_etiqueta .=  "<br> {$titular2['endereco']}";
if(isset($titular2['bairro'])) 
	$titular2_etiqueta .=  "<br> {$titular2['bairro']}";
if(isset($titular2['cep'])) 
	$titular2_etiqueta .=  " {$titular2['cep']}";
if(isset($titular2['estado']) && isset($titular2['cidade'])) 
	$titular2_etiqueta .=  "<br> {$titular2['cidade']}-{$titular2['estado']}";

$titular3_etiqueta = "Ilmo(a) Sr(a). <br> {$titular3['nome']}";
$titular3_etiqueta .=  "<br> {$titular3['endereco']}";
if(isset($titular3['bairro'])) 
	$titular3_etiqueta .=  "<br> {$titular3['bairro']}";
if(isset($titular3['cep'])) 
	$titular3_etiqueta .=  " {$titular3['cep']}";
if(isset($titular3['estado']) && isset($titular3['cidade'])) 
	$titular3_etiqueta .=  "<br> {$titular3['cidade']}-{$titular3['estado']}";


$suplente1_etiqueta = "Ilmo(a) Sr(a). <br> {$suplente1['nome']}";
$suplente1_etiqueta .=  "<br> {$suplente1['endereco']}";
if(isset($suplente1['bairro'])) 
	$suplente1_etiqueta .=  "<br> {$suplente1['bairro']}";
if(isset($suplente1['cep'])) 
	$suplente1_etiqueta .=  " {$suplente1['cep']}";
if(isset($suplente1['estado']) && isset($suplente1['cidade'])) 
	$suplente1_etiqueta .=  "<br> {$suplente1['cidade']}-{$suplente1['estado']}";

$suplente2_etiqueta = "Ilmo(a) Sr(a). <br> {$suplente2['nome']}";
$suplente2_etiqueta .=  "<br> {$suplente2['endereco']}";
if(isset($suplente2['bairro'])) 
	$suplente2_etiqueta .=  "<br> {$suplente2['bairro']}";
if(isset($suplente2['cep'])) 
	$suplente2_etiqueta .=  " {$suplente2['cep']}";
if(isset($suplente2['estado']) && isset($suplente2['cidade'])) 
	$suplente2_etiqueta .=  "<br> {$suplente2['cidade']}-{$suplente2['estado']}";

if(isset($titular4)) {
	$titular4_etiqueta = "Ilmo(a) Sr(a). <br> {$titular4['nome']}";
	$titular4_etiqueta .=  "<br> {$titular4['endereco']}";
	if(isset($titular4['bairro'])) 
		$titular4_etiqueta .=  "<br> {$titular4['bairro']}";
	if(isset($titular4['cep'])) 
		$titular4_etiqueta .=  " {$titular4['cep']}";
	if(isset($titular4['estado']) && isset($titular4['cidade'])) 
		$titular4_etiqueta .=  "<br> {$titular4['cidade']}-{$titular4['estado']}";
} else $titular4_etiqueta = " ";

if(isset($titular5)) {
	$titular5_etiqueta = "Ilmo(a) Sr(a). <br> {$titular5['nome']}";
	$titular5_etiqueta .=  "<br> {$titular5['endereco']}";
	if(isset($titular5['bairro'])) 
		$titular5_etiqueta .=  "<br> {$titular5['bairro']}";
	if(isset($titular5['cep'])) 
		$titular5_etiqueta .=  " {$titular5['cep']}";
	if(isset($titular5['estado']) && isset($titular5['cidade'])) 
		$titular5_etiqueta .=  "<br> {$titular5['cidade']}-{$titular5['estado']}";
} else $titular5_etiqueta = " ";

$html_to_PDF .= "
		<table border=\"0\" width=\"19cm\" class=\"etiqueta\">
		<tr>
   	  <td width=\"9.85cm\" height=\"3.33cm\"> $orientador_etiqueta </td> 
			<td width=\"9.85cm\"> $titular2_etiqueta </td>
		</tr>
		<tr>
   	  <td  height=\"3.33cm\"> $titular3_etiqueta  </td> 
			<td > $suplente1_etiqueta </td> 
		</tr>
		<tr>
   	  <td  height=\"3.33cm\"> $suplente2_etiqueta  </td> 
			<td>  $titular4_etiqueta 	</td> 
		</tr>
		<tr>
   	 <td height=\"3.33cm\">  $titular5_etiqueta </td> 
			<td> 	</td>
		</tr> ";

	$html_to_PDF .= "</table>";

$html_to_PDF .= '</body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("etiquetas.pdf");

?>


	 





