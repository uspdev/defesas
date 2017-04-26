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

$usuario = $user->verUsuario($_SESSION['codpes']);

$html_to_PDF = paginapdf($candidato,'',$info_banco,$cabecalhoFFLCH,$htmlFFLCH);

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("passagem.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html) {
	global $usuario;
	$html .= $cabecalhoFFLCH;
	$html .= "<div class=\"data_hoje\">{$candidato['hoje']}</div>";
	$html .= "<left> {$info_banco[0]['agencia_viagem']} </left>"; 
	$html .= "<br> <ul> 
										<li>Requisição passagem aérea nº <b>{$_POST['requisicao']} </b> </li>  
										<li>Programa: <b>{$candidato['nome_area']} </b> </li>  
										<li><b>{$candidato['nivel']} </b> </li>  
										<li>Defesa do Sr.(a): <b> {$candidato['nome']} </b> </li>  
										<li>Orientador(a): Prof(a) Dr(a)<b> {$candidato['orientador']} </b> </li>  

";
	$html .= "<div class=\"justificar\" style=\"text-indent:1cm;\" >{$info_banco[0]['agencia_texto']} </div>";
	$html .= "<div class=\"boxPassagem\">  
							Interessado(a): Prof(a). Dr(a). <b> {$_POST['nome_docente']}</b> <br>
							E-mail: <b>{$_POST['email_docente']}</b> <br>
							Telefone:<b> {$_POST['telefone_docente']}</b> <br>
							Data da defesa:<b> {$candidato['data_placa']}</b> <br>
							Trajeto da passagem aérea <b> {$_POST['trajeto']}</b> <br>
							</div> <br>";
	$html .= "<table style=\"width:15.5cm;\"> 
						<tr> 
							<td style=\"width:7.25cm;\"> <center> <b>IDA </b></center></td>
							<td> <center><b>VOLTA </b> </center> </td>
						</tr>
						<tr>
							<td> {$_POST['ida']} </td>
							<td> {$_POST['volta']} </td>
						</tr>
						</table> <br>";

	$html .= "<p><b> Solicitamos a gentileza no sentido de comunicar aos professores interessados, com antecedência, n° do PTA e nome da companhia aérea.  </b></p> <br> <br> "; 
	$html .= "<center><b> Favor faturar para: {$info_banco[0]['faturar_para']} </b></center> <br>";


	$html .= "<center> <div style=\"margin-top:2cm;\"> Atenciosamente, </div> <br><br>
							<br> <b> 
								{$usuario[0]['nome']} 
								<br> Serviço de Pós-Graduação - FFLCH/USP  
							</b> </center>";


	return $html;
}

?>

