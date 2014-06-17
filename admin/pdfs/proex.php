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
if(!isset($_POST['cpf_docente'])) $_POST['cpf_docente'] = "&nbsp;";
if(!isset($_POST['documento'])) $_POST['documento'] = "&nbsp;";

$html_to_PDF = '<html> <head> <style type="text/css">
body {padding:0px; font-size: large;}
.negrito {font-weight: bolder;}
.justificar{text-align: justify;}
.etiqueta{font-size: 14px;}
table { background #fff; border-collapse: collapse; margin:4px; }
tr, td { border: 1px #000 solid; padding: 4 }
.nome {text-align:center; font-size:7px; padding:0px; }
.assinatura{border-bottom:1px solid;}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';


$html_to_PDF = paginapdf($candidato,'',$info_banco,$cabecalhoFFLCH,$htmlFFLCH);

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("proex.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html) {
	$html .= "
		<table width=\"17cm\" class=\"negrito\" style=\"margin-top:2.5cm\">
			<tr>
   	 		<td width=\"1.5cm\" height=\"1.5cm\" style=\"border-right:0px\" > <img src=\"../../images/capes.png\" style=\"float:left;\"> </td>
				<td width=\"9.5cm\" style=\"border-left:0px\" ><span style=\"font-size: 10px;\">
					<center>CAPES - COORDENAÇÃO DE APERFEIÇOAMENTO DE PESSOAL DE NÍVEL SUPERIOR </center> </span> </td> 
				<td> <span style=\"font-size: 7px; \">PROJETO N° <br><br><br><br> </span> </td> 
			</tr> 
		</table> ";
	$html .= "<br>";
	$html .= "
		<table width=\"17cm\">
			<tr>
				<td height=\"0.4cm\" style=\"background-color:gray; padding:0px;\">
					<center> RECIBO </center>
				</td>
			</tr> 
			<tr>
				<td>
				<div class=\"justificar\">	Recebi da Fundação CAPES / <b>{$candidato['coordenador']}</b> a importância de <b>{$_POST['importancia']}</b>, em caráter eventual e sem vínculo empregatício, a título de DIÁRIAS(S), no período de <b>{$_POST['periodo']}</b> pela participação na banca examinadora de <b>{$candidato['nivel']}</b> de <b>{$candidato['nome']}</b>, no dia <b>{$candidato['data_proex']}.</b></div> 
					<table width=\"15cm\" style=\"border:0px;\"> 
						<tr style=\"border:0px;\">
							<td style=\"border:0px;\"><b>Deduções(*)  </td>
							<td style=\"border:0px;\"> VALOR DA REMUNERAÇÃO <br> {$_POST['outro_tipo']} <br> Líquido recebido</td>
							<td style=\"border:0px;\"> {$_POST['valor']} <br> {$_POST['outro_valor']} <br> {$_POST['liquido']} </td>
						</tr>
					</table>
				</td>
			</tr>
		</table> ";
	$html .= "<p style=\"font-size: 9px; \">(*) Não se aplica a diárias e sim a serviços prestados por pessoa física quando essa não possui talonários de Nota Fiscal de Serviços. Só aplicar deduções (INSS,ISS etc.), quando for o caso. </p>";
	$html .= "<br>";
	$html .= "
		<table width=\"17cm\">
			<tr>
				<td height=\"0.4cm\" style=\"background-color:gray; padding:0px;\" colspan=\"2\">
					<center> IDENTIFICAÇÃO DO PRESTADOR DE SERVIÇO </center>
				</td>
			</tr> 
			<tr>
				<td> Nome: {$_POST['nome_docente']}	</td>
				<td> CPF: {$_POST['cpf_docente']} </td>
			</tr>
			<tr>
				<td> Profissão: <br> PROFESSOR DOUTOR	</td>
				<td> RG/Passaporte(se estrangeiro):<br> {$_POST['documento']} </td>
			</tr>
			<tr>
				<td colspan=\"2\"> Endereço Completo: <br> {$_POST['endereco']} </td>
			</tr>

		</table> ";
	$html .= "<br>";
	$html .= "
		<table width=\"17cm\" >
			<tr>
				<td height=\"0.4cm\" style=\"background-color:gray; padding:0px;\" colspan=\"2\">
					<center> TESTEMUNHAS (na falta dos dados de identificação do prestador de serviço) </center>
				</td>
			</tr> 
			<tr>
				<td width=\"12cm\"> (1)Nome:	</td>
				<td> CPF: </td>
			</tr>
			<tr>
				<td> Profissão: 	</td>
				<td> RG: </td>
			</tr>
			<tr>
				<td width=\"10cm\"> Endereço Completo: </td>
				<td> Assinatura: </td>
			</tr>
			<tr>
				<td width=\"12cm\"> (2)Nome:	</td>
				<td> CPF: </td>
			</tr>
			<tr>
				<td> Profissão: 	</td>
				<td> RG: </td>
			</tr>
			<tr>
				<td width=\"10cm\"> Endereço Completo: </td>
				<td> Assinatura: </td>
			</tr>

		</table> ";
	$html .= "<br>";
	$html .= "
		<table width=\"17cm\">
			<tr>
				<td height=\"0.4cm\" style=\"background-color:gray; padding:0px;\" colspan=\"2\">
					<center> ASSINATURA BENEFICIÁRIO/PRESTADOR DO SERVIÇO </center>
				</td>
			</tr> 
			<tr style=\"font-size:10px;\">
				<td width=\"8.5cm\"> Atesto que os serviços constantes do presente recibo foram prestados. <br><br> Em ___/___/___.</td>
				<td> Por ser verdade, firmo o presente recibo. <br> <br> <p style=\"text-align:right;\"> São Paulo, {$candidato['data_proex']} </p> <br><br></td>
			</tr>
			<tr>
				<td>  <b> <center>{$candidato['coordenador']}</b> </center>	</td>
				<td> <b> <center>{$_POST['nome_docente']}</b> </center> </td>
			</tr>

		</table> ";
$html .= "<p style=\"font-size: 9px; \"> <b>ATENÇÃO:</b> Utilizar esse modelo quando ocorrer pagamento de diárias ou remuneração de serviço a pessoas físicas que não possuam talonários de Notas Fiscais de Serviços (<b> Outros Serviços de Terceiros - Pessoas Físicas </b>) </p>";
					
	
	return $html;
}

?>

