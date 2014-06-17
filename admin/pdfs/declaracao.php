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

$usuario = $user->verUsuario($_SESSION['codpes']);

if(isset($candidato['nivel'])) {
	$html_to_PDF = paginapdf($candidato,$orientador,$info_banco,$cabecalhoFFLCH,$htmlFFLCH);
	$html_to_PDF = paginapdf($candidato,$titular2,$info_banco,$cabecalhoFFLCH,$html_to_PDF);
	if($candidato['nivel'] == 'Mestrado') $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$cabecalhoFFLCH,$html_to_PDF,TRUE);	
		else $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$cabecalhoFFLCH,$html_to_PDF);	
	if($candidato['nivel'] == 'Doutorado'){
  	$html_to_PDF = paginapdf($candidato,$titular4,$info_banco,$cabecalhoFFLCH,$html_to_PDF);	
  	$html_to_PDF = paginapdf($candidato,$titular5,$info_banco,$cabecalhoFFLCH,$html_to_PDF,TRUE);	
	}
}

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("declaracao.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html,$ultimaPagina=FALSE) {
	global $usuario;
	$info_banco['declaracao'] = str_replace('%docente_nome',$docente['nome'],$info_banco[0]['declaracao']);
	$info_banco['declaracao'] = str_replace('%nivel',$candidato['nivel'],$info_banco['declaracao']);
	$info_banco['declaracao'] = str_replace('%candidato_nome',$candidato['nome'],$info_banco['declaracao']);
	$info_banco['declaracao'] = str_replace('%titulo',$candidato['titulo'],$info_banco['declaracao']);
	$info_banco['declaracao'] = str_replace('%area',$candidato['nome_area'],$info_banco['declaracao']);
	$info_banco['declaracao'] = str_replace('%orientador',$candidato['orientador'],$info_banco['declaracao']);

	$html .= $cabecalhoFFLCH;
	$html .= "<div class=\"data_hoje\">São Paulo, {$candidato['data_proex']}</div>";
	$html .= "<center> <u> <h1> DECLARAÇÃO </h1> </u></center>"; 
	$html .= "<br><br><br>";
	$html .= "<p class=\"recuo justificar\" style=\"line-height: 190%;\"> {$info_banco['declaracao']} </p> <br><br>";

	$html .= "
		<table border=\"0\" width=\"16cm\" class=\"negrito\">
		<tr>
   	 <td> {$candidato['titular2']} </td> 
			<td> {$candidato['titular2_lotado']} 	</td>
		</tr>
		<tr>
   	 <td> {$candidato['titular3']} </td> 
			<td> {$candidato['titular3_lotado']} 	</td> 
		</tr>";
	if ($candidato['nivel'] == 'Doutorado') {
	$html .= "
		<tr>
   	 <td> {$candidato['titular4']} </td> 
			<td> {$candidato['titular4_lotado']} 	</td>
		</tr>
		<tr>
   	 <td> {$candidato['titular5']} </td> 
			<td> {$candidato['titular5_lotado']} 	</td> 
		</tr>";
	}
	$html .= "</table>";

	$html .= "<center> <p style=\"margin-top:4cm;\"> Atenciosamente, </p> <br><br> 
								<b> {$usuario[0]['nome']} 
								<br> Defesas de Mestrado e Doutorado da FFLCH /USP 
							</b> </center>";

	$html .= " <center> <div id=\"footer\"> 
											{$info_banco[0]['rodape_oficios']} 
					   </div> </center> ";



	if(!$ultimaPagina) $html .= "	<p style=\"page-break-before: always\">&nbsp;</p>"; 
	return $html;
}

?>

