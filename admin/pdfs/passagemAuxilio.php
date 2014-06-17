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

$html_to_PDF = paginapdf($candidato,'',$info_banco,$cabecalhoFFLCH,$htmlFFLCH);

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("passagemAux.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html) {
	global $usuario;
	$html .= "<h3><center> UNIVERSIDADE DE SÃO PAULO <br>
						FACULDADE DE FILOSOFIA, LETRAS E CIÊNCIAS HUMANAS <br>
						SERVIÇO DE COMPRAS</center> </h3>";

	$html .= "<left> {$info_banco[0]['header_auxilio']} </left>"; 
	$html .= "<left> <u><b>{$_POST['processo']}</b></u> </left> <br>"; 

	$html .= "<p> Banca de defesa de <b> {$candidato['nome']} </p> 
						<p> Passageiro(a) {$_POST['nome_docente']} </p> 
						<p> Itinerário: {$_POST['itinerario']} </p> 
						<p> Partida: {$_POST['partida']} </p> 
						<p> Retorno: {$_POST['retorno']} </p> 
						<p> Telefone: {$_POST['telefone_docente']} </p> 
						<p> E-mail:  {$_POST['email_docente']} </p> 
						<div class=\"justificar\"> {$info_banco[0]['obs_passagem']} </div>
					";
	$html .= "<p>{$candidato['hoje']}</p>";
	$html .= "<center> <p style=\"margin-top:3cm;\">
							<br> <b> 
								{$usuario[0]['nome']} <br>
								{$usuario[0]['codpes']}
								<br> SPG-FFLCH-USP 
							</b> </center>";

	
	return $html;
}

?>

