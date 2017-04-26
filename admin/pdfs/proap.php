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

//Insere branco nos campos faltantes
if(!isset($_POST['cpf_docente'])) $_POST['cpf_docente'] = "&nbsp;";
if(!isset($_POST['documento'])) $_POST['documento'] = "&nbsp;";
//if(!isset($_POST['bairro'])) $_POST['bairro'] = "&nbsp;";


$html_to_PDF = '<html> <head> <style type="text/css">
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';

$headerProap = '
		<div id="headerFFLCH">
		<table border="0" width="16cm">
		<tr>
   	 <td width="2cm"> <img src="../../images/fflch.gif" width="95%"/> </td> 
			<td width="16cm"> <span style="font-size:20px; font-style:normal; "> <b> UNIVERSIDADE DE SÃO PAULO </b> </span> <br>   
												<span style="font-size:15px;">Faculdade de Filosofia, Letras e Ciências Humanas</span> <br>
												<span style="font-size:12x; font-style:normal; "> <b>CNPJ. 63.025.530/0016-90</b> </span> <br> 
												<span style="font-size:10px; font-style:normal; ">Rua do Lago, 717 - Sl. 131 - Cid. Universitária - CEP: 05508-900 - Fone/Fax: 3091-4878 </span> 
		</td>
		</tr>
 	 </table>
	</div>';



$html_to_PDF = paginapdf($candidato,'',$info_banco,$headerProap,$html_to_PDF);

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("proap.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$cabecalhoFFLCH,$html) {
	$html .= $cabecalhoFFLCH;	
	$html .= "<div id=\"proap\">";	
	$html .= "<center> <span style=\"font-size:16px;  \"> <b> RECIBO DE DIÁRIAS - BANCA EXAMINADORA </b> </span> </center> ";	
	$html .= "<center> <span style=\"font-size:14px;  \"> <b> PROAP {$_POST['ano']} </b> </span> </center> ";	
	$html .= "<hr>";
	$html .= "<table width=\"16.5cm\" style=\"border:0px;\">
							<tr>
								<td style=\"border:0px;\" colspan=\"2\">Nome do Convidado: {$_POST['nome_docente']} </td>
							</tr>
							<tr>
								<td style=\"border:0px;\"> CPF: {$_POST['cpf_docente']}</td>
								<td style=\"border:0px;\">  RG: {$_POST['documento']}  </td>
							</tr>
					</table>";				
	$html .= "<hr>";
	$html .= "<table width=\"16.5cm\" style=\"border:0px;\">
							<tr>
								<td style=\"border:0px;\">Unidade: </td>
								<td style=\"border:0px;\"> {$_POST['lotado']} </td>
								<td style=\"border:0px;\">Cargo: </td>
								<td style=\"border:0px;\"> <b> Professor(a) Doutor(a) </b> </td>
							</tr>
							<tr>
								<td style=\"border:0px;\">Pós Graduação em: </td>
								<td style=\"border:0px;\"> {$candidato['nome_area']} </td>
								<td style=\"border:0px;\"> Mês: </td>
								<td style=\"border:0px;\"> <b> {$candidato['data_mes']}</b> </td>
							</tr>
					</table>";			
	$html .= "<center>";
	$html .= "<br> <div style=\"font-size:16px; \">  <b>DISCRIMINAÇÃO</b> </span> </div><br> ";		
	$html .= "<table width=\"18.5cm\" style=\"border:1px;\">
							<tr>
								<td style=\"border:1px solid;\" colspan=\"2\"> <b> CHEGADA NA SEDE</b> </td>
								<td style=\"border:1px solid;\" rowspan=\"2\"> <b> ORIGEM  <b> </td>
								<td style=\"border:1px solid;\" colspan=\"2\"> <b> SAÍDA DA SEDE </td>
								<td style=\"border:1px solid;\"  rowspan=\"2\"> <b> N° DIÁRIAS </b> </td>
								<td style=\"border:1px solid;\"  rowspan=\"2\"> <b> TOTAL </b> </td>
							</tr>
							<tr>
								<td style=\"border:1px solid;\"> DIA</td>
								<td style=\"border:1px solid;\"> HORA </td>
								<td style=\"border:1px solid;\"> DIA</td>
								<td style=\"border:1px solid;\"> HORA </td>
							</tr>
							<tr>
								<td style=\"border:1px solid;\"> {$_POST['chegada']} </td>
								<td style=\"border:1px solid;\">  </td>
								<td style=\"border:1px solid;\"> {$_POST['origem']}  </td>
								<td style=\"border:1px solid;\"> {$_POST['saida']}  </td>
								<td style=\"border:1px solid;\">  </td>
								<td style=\"border:1px solid;\"> {$_POST['diaria_proap']} </td>
								<td style=\"border:1px solid;\"> {$_POST['valor_proap']}  </td>
							</tr>
							<tr>
								<td style=\"border:0;\" colspan=\"4\">  Valor da Diária com pernoite </td>
								<td style=\"border:0\"> {$info_banco[0]['diaria_com_pernoite']}   </td>
								<td style=\"border:1px solid;\"> <b> TOTAL </b> </td>
								<td style=\"border:1px solid;\"> <b> {$_POST['valor_proap']}  </b> </td>
							</tr>
					</table>";	
	$html .= "</center>";
	$html .= "<br><br><br><br><br>Recebi o valor de {$_POST['valor_proap']} ({$_POST['extenso']}) <br><br><br>";
	$html .= "Referente às diárias a que fiz jus conforme demonstração supra. <br><br><br>";
	$html .= "São Paulo, {$candidato['data_proex']} <br><br><br><br>";
	$html .= "<table width=\"18cm\"> 
							<tr>
								<td style=\"border:0;\"> <hr style=\"width:10cm;\"> 
									{$_POST['nome_docente']} <br> 
									<b>{$_POST['endereco']}</b>
								</td>
							</tr> 
						</table>";

	$html .= "<center> <b> {$_POST['email_docente']} </b> </center> " ;
	$html .= "<br> <center> <b>RELATÓRIO </center></b> <br> <div class=\"justificar\">  {$info_banco[0]['capes_proap']} </div> ";
	$html .= "Banca de: {$candidato['nome']} <br><br><br><br><br><br><br>";
$html .= "<table width=\"18cm\"> 
							<tr>
								<td style=\"border:0;\"> <hr style=\"width:10cm;\"> 
									<center>Assinatura do(a) Coordenador(a)</center>
								</td>
							</tr> 
						</table>";

	$html .= "</div>"; # Fecha a classe courier
	
	return $html;
}

?>

