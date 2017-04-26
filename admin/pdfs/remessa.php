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

$html_to_PDF = '<html> <head> <style type="text/css">
body {margin:0px; padding:0px;}
.negrito {font-weight: bolder;}
.justificar{text-align: justify;}
.etiqueta{font-size: 14px;}
table { background #fff; border-collapse: collapse; margin:4px; }
tr, td { border: 1px #000 solid; padding: 4 }
.nome {text-align:center; font-size:7px; padding:0px; }
.assinatura{border-bottom:1px solid;}
body {font-size: large; margin-top:3cm;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body>';

if(isset($candidato['nivel'])) {
	if($orientador['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$orientador,$info_banco,$html_to_PDF);
	if($titular2['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$titular2,$info_banco,$html_to_PDF);
	if($titular3['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$titular3,$info_banco,$html_to_PDF);	
	if($candidato['nivel'] == 'Doutorado'){
  	if($titular4['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$titular4,$info_banco,$html_to_PDF);	
  	if($titular5['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$titular5,$info_banco,$html_to_PDF);	
	}
	if($suplente1['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$suplente1,$info_banco,$html_to_PDF);
	if($suplente2['docente_usp']=='sim') $html_to_PDF = paginapdf($candidato,$suplente2,$info_banco,$html_to_PDF,TRUE);
}

$html_to_PDF .= '</div> </body> </html>';

$htmlFFLCH = utf8_encode($html_to_PDF); 
$dompdf = new DOMPDF();
$dompdf->set_paper("a4");
$dompdf->load_html($html_to_PDF);
$dompdf->render();
$dompdf->stream("remessas.pdf");


/*********************************************************
Cada vez que a função paginapdf é chamada, uma nova página 
é adicionada ao pdf final, que é criado a chamarmos o método
Output do objeto pdf =)
*********************************************************/

function paginapdf($candidato,$docente,$info_banco,$html,$ultimaPagina=FALSE) {
	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> RECIBO DE REMESSA DE DOCUMENTOS </td> 
			<td  width=\"4cm\"> <u>DATA:</u> </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> <u>DO:</u> SERVIÇO DE PÓS-GRADUAÇÃO DA FFLCH <br>
				  <u>PARA:</u>  {$docente['endereco']} <div style=\"text-indent:1.5cm;\"> A/C: Prof(a). Dr(a). {$docente['nome']} </div> </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> <u>ASSUNTO:</u> encaminho exemplar do trabalho do aluno(a) Sr(a). {$candidato['nome']} </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td width=\"9cm\"> Recebido em: ____/____/____ </td> 
			<td>  <div class=\"assinatura\">&nbsp;</div> <div class=\"nome\">Nome Legível</div>  </td> 
		</tr> </table> ";
	
	$html .= "<br><br><br><br><br><br><br><br><br><br><br><br>"; 

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> RECIBO DE REMESSA DE DOCUMENTOS </td> 
			<td  width=\"4cm\"> <u>DATA:</u> </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> <u>DO:</u> SERVIÇO DE PÓS-GRADUAÇÃO DA FFLCH <br>
				  <u>PARA:</u>  {$docente['endereco']} <div style=\"text-indent:1.5cm;\"> A/C: Prof(a). Dr(a). {$docente['nome']} </div> </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td> <u>ASSUNTO:</u> encaminho exemplar do trabalho do aluno(a) Sr(a). {$candidato['nome']} </td> 
		</tr> </table> ";

	$html .= "
		<table width=\"18cm\" class=\"negrito\">
		<tr>
   	 <td width=\"9cm\"> Recebido em: ____/____/____ </td> 
			<td>  <div class=\"assinatura\">&nbsp;</div> <div class=\"nome\">Nome Legível</div>  </td> 
		</tr> </table> ";
	


	if(!$ultimaPagina) $html .= "	<p style=\"page-break-before: always\">&nbsp;</p>"; 
	return $html;
}

?>

