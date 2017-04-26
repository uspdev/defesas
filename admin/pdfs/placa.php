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
require "../../vendor/autoload.php";
use Dompdf\Dompdf;
if(isset($html_to_PDF)) unset($html_to_PDF); 

$html_to_PDF = '<html> <head> 
<style type="text/css">
	body {background-image: url(../../images/placa.jpg); 
			 background-repeat:no-repeat; 
			 background-position:center;
			 font-family: DejaVu Sans, sans-serif;
			 }
	.cabecalho {font-weight: bolder; text-align: center; font-size: large; margin-top: 2cm; }
	.candidato {font-weight: bolder; text-align: left; font-size: x-large; padding: 0.3cm; width: 24cm; margin-left:2cm;}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';

$html_to_PDF .= "
			<div class=\"cabecalho\"> Universidade de São Paulo <br>
			 Faculdade de Filosofia, Letras e Ciências Humanas <br> 
			Serviço de Pós-Graduação </div>  	<br><br><br>
			<div class=\"candidato\"> Candidato(a): {$candidato['nome']} </div> 
			<div class=\"candidato\"> Data: {$candidato['data_placa']}. </div>  
			<div class=\"candidato\"> Defesa de {$candidato['nivel']} em {$candidato['nome_area']} </div> 
			<div class=\"candidato\"> Título: <i> \"{$candidato['titulo']}\" </i> </div>  	


";

$html_to_PDF .= '</body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper('a4','landscape');
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("placa.pdf");


?>

