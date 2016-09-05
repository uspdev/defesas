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
  if($candidato['orientador_votante']=='nao') {
    $html_to_PDF = paginapdf($candidato,$orientador,$info_banco,$cabecalhoFFLCH,$htmlFFLCH);
    $html_to_PDF = paginapdf($candidato,$titular1,$info_banco,$cabecalhoFFLCH,$html_to_PDF);
    $html_to_PDF = paginapdf($candidato,$titular2,$info_banco,$cabecalhoFFLCH,$html_to_PDF);
  }
  else {
    $html_to_PDF = paginapdf($candidato,$orientador,$info_banco,$cabecalhoFFLCH,$htmlFFLCH);
    $html_to_PDF = paginapdf($candidato,$titular2,$info_banco,$cabecalhoFFLCH,$htmlFFLCH);
  }
  // Qual vai ser a última página?
  if($candidato['nivel'] == 'Mestrado' & $candidato['regimento'] == 'antigo') 
    $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$cabecalhoFFLCH,$html_to_PDF,TRUE);
  else if($candidato['regimento'] == 'novo')
    $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$cabecalhoFFLCH,$html_to_PDF,TRUE);
  else if($candidato['nivel'] == 'Doutorado' & $candidato['regimento'] == 'antigo') {
    $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$cabecalhoFFLCH,$html_to_PDF);
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
$dompdf->stream("titulares.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html,$ultimaPagina=FALSE) {
	global $usuario;
	$html .= $cabecalhoFFLCH;
	$html .= "<div class=\"data_hoje\">{$candidato['hoje']}</div>";

	$html .= "<div class=\"moremargin\">Assunto: Banca Examinadora de <b>{$candidato['nivel']}</b></div> ";
	$html .= "<div class=\"moremargin\">Candidato(a): <b>{$candidato['nome']}</b> </div>";
	$html .= "<div class=\"moremargin\">Área: <b>{$candidato['nome_area']}</b> </div>";
	$html .= "<div class=\"moremargin\">Orientador(a) Prof(a). Dr(a). {$candidato['orientador']}</div>";
	$html .= "<div class=\"moremargin\">Título do Trabalho: <i>{$candidato['titulo']} </i></div>";
	$html .= "<br>";
	$html .= "<div class=\"importante\"> {$info_banco[0]['importante_oficio']} </div>";
	$html .= "<br> <p> <i>Data e hora da defesa:  </i> <b> {$candidato['data_placa']} </b> <br> ";
	$html .= " <i>Local:</i> <b> {$candidato['nome_sala']} </b> - {$candidato['predio']} </p>  ";
	$html .= "<i>Composição da banca examinadora:</i> ";
	$html .= "
<table border=\"0\" width=\"16cm\">
<tr>
  <td> {$candidato['titular1']} </td> 
  <td> {$candidato['titular1_lotado']} 	</td>
</tr>
<tr>
  <td> {$candidato['titular2']} </td> 
  <td> {$candidato['titular2_lotado']} 	</td> 
</tr>
<tr>
  <td> {$candidato['titular3']} </td> 
  <td> {$candidato['titular3_lotado']} 	</td> 
</tr>

";
	if ($candidato['nivel'] == 'Doutorado' & $candidato['regimento'] == 'antigo') {
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
	$html .= "<br>";
	$html .= "<div class=\"importante\" > {$info_banco[0]['regimento']} </div>";
	$html .= "<br>";
	$html .= "<center> <p> Atenciosamente, 
							<br> <b> 
								{$usuario[0]['nome']}
								<br> Defesas de Mestrado e Doutorado da FFLCH /USP 
							</b> </center>";
	$html .= "<br><br><br>";
	$html .= "Ilmo(a). Sr(a). {$docente['nome']}<br>";
	
	$html .= $docente['endereco'];

	if(!empty($docente['cep'])) $html .= ", CEP: {$docente['cep']}";
	if(!empty($docente['cidade'])) $html .= "<br>  {$docente['cidade']}";
	if(!empty($docente['estado'])) $html .= " - {$docente['estado']}";
	if(!empty($docente['telefone']))  $html .= " <br> telefone: {$docente['telefone']}";
	if(!empty($docente['email']))	$html .= "<br>e-mail: {$docente['email']}";
	$html .= "<center> <div id=\"footer\"> 
											{$info_banco[0]['rodape_oficios']} 
						</div> </center> ";

	if(!$ultimaPagina) $html .= "	<p style=\"page-break-before: always\">&nbsp;</p>"; 
	return $html;
}

?>

