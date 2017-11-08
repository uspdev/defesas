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

if(empty($_GET['membro'])) {
    die('Especificar membro...');
}

$membro = $docente->verDocente($_GET['membro']);
$membro = $membro[0];

include('./loadCandidato.php');
require "../../vendor/autoload.php";
use Dompdf\Dompdf;
if(isset($html_to_PDF)) unset($html_to_PDF); 

$usuario = $user->verUsuario($_SESSION['codpes']);

$html_to_PDF = paginapdf($candidato,$membro,$info_banco,$cabecalhoFFLCH,$htmlFFLCH,TRUE);

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("{$membro['nome']}.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$suplente,$info_banco,$cabecalhoFFLCH,$html,$ultimaPagina=FALSE) {
	global $usuario;
	$info=array();
	$info['oficio_suplente'] = str_replace('%data_oficio_suplente',$candidato['data_oficio_suplente'],$info_banco[0]['oficio_suplente']);
	$info['oficio_suplente'] = str_replace('%nome_sala',$candidato['nome_sala'],$info['oficio_suplente']);
	$info['oficio_suplente'] = str_replace('%predio',$candidato['predio'],$info['oficio_suplente']);
	$html .= $cabecalhoFFLCH;
	$html .= "<div class=\"data_hoje\">{$candidato['hoje']}</div>";
	$html .= "Ilmo(a) Sr(a).<br>
               Prof.(a) Dr.(a) <b> {$suplente['nome']} </b> <br>";
	$html .= $suplente['endereco'];
	if(!empty($suplente['cep'])) $html .= ", CEP: {$suplente['cep']}";
	if(!empty($suplente['cidade'])) $html .= "<br>  {$suplente['cidade']}";
	if(!empty($suplente['estado'])) $html .= " - {$suplente['estado']}";
	if(!empty($suplente['telefone']))  $html .= " <br> telefone: {$suplente['telefone']}";
	if(!empty($suplente['email']))	$html .= "<br>e-mail: {$suplente['email']}";

	$html .= "<br><br>";
	$html .= "<br> <div class=\"boxSuplente\">
						 		<b> Assunto: </b> Defesa de <b> {$candidato['nivel']} </b> <br><br>
								<b> Candidato(a): </b> {$candidato['nome']} <br> <br>
								<b> Orientador(a): </b> {$candidato['orientador']} <br> <br>
								<b> Título do Trabalho: {$candidato['titulo']} </b> <br> 
						</div>";
	$html .= "<br><br>";
	$html .= "Sr(a). Prof(a).";
	$html .= " <div class=\"oficioSuplente\">{$info['oficio_suplente']} </div>";

	$html .= " <center> <div style=\"margin-top:2cm; \" > Atenciosamente, </div>  
							 <b>
								{$usuario[0]['nome']}
								- Defesas de Mestrado e Doutorado da FFLCH /USP 
							</b> </center>";

	$html .= " <center> <div id=\"footer\"> 
											{$info_banco[0]['rodape_oficios']} 
						</div> </center> ";


	if(!$ultimaPagina) $html .= "	<p style=\"page-break-before: always\">&nbsp;</p>"; 
	return $html;
}

?>

