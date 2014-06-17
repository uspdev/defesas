<?php
/*****************************************************************************
Este arquivo carregará as variáveis do candidato para outros arquivos.
******************************************************************************/

if(!empty($_GET['id_candidato'])) {
	$where = "id_candidato = {$_GET['id_candidato']}";
	$vetor_candidato = $obj_candidato->listarCandidatos('viewcandidato',$where);
	if(!$vetor_candidato) die("Candidato nao cadastrado");
 else {
  foreach ($vetor_candidato[0] as $key=>$value) {
   $candidato[$key] = $value; 
  }
 }
} else die('Sem candidato...');


/***************************************************************************** 
Data e Horário em diversos formato
******************************************************************************/ 
if(isset($candidato['data_horario'])) {
	$vetor = explode(' ',$candidato['data_horario']);
	$candidato['data'] = $vetor[0];
	$candidato['hora'] = $vetor[1]; 
}
//Para usar o mês em português
$mes =array("mes",
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
            );

//Formato: "28 de Novembro de 2012 - 10:30h" 
$auxiliar = array();
$auxiliar = explode('-',$candidato['data']); 
$auxiliar[1] = ltrim($auxiliar[1],'0');
$candidato['data_oficio_titular'] = $auxiliar[2] . 
                          " de " . 
                          $mes[$auxiliar[1]] . 
                          " de " . 
                          $auxiliar[0] . 
                          " - " . 
                          substr(($candidato['hora']),0,-3) . 
                          "h";
//Ofício Suplente
$candidato['data_oficio_suplente'] = $candidato['data_oficio_titular'];

//Formato: "28 de Novembro de 2012, às 10h30" 
$auxiliar = array();
$auxiliar = explode('-',$candidato['data']); 
$auxiliar[1] = ltrim($auxiliar[1],'0');
$candidato['data_placa'] = $auxiliar[2] . 
                          " de " . 
                          $mes[$auxiliar[1]] . 
                          " de " . 
                          $auxiliar[0] . 
                          " às " . 
                          substr(($candidato['hora']),0,-6) . 
                          "h" . 
													substr(($candidato['hora']),3,2);

//Formato: "28 de Novembro de 2012" 
$auxiliar = array();
$auxiliar = explode('-',$candidato['data']); 
$auxiliar[1] = ltrim($auxiliar[1],'0');
$candidato['data_proex'] = $auxiliar[2] . 
                          " de " . 
                          $mes[$auxiliar[1]] . 
                          " de " . 
                          $auxiliar[0];

//Formato: "Novembro de 2012" 
$auxiliar = array();
$auxiliar = explode('-',$candidato['data']); 
$auxiliar[1] = ltrim($auxiliar[1],'0');
$candidato['data_mes'] =  $mes[$auxiliar[1]] . 
                          " de " . 
                          $auxiliar[0];

//Formato: 30/12/2012 e 20:00
$candidato['data_defesa'] = implode('/',array_reverse(explode('-',$candidato['data']))); 
$candidato['horario_defesa'] = substr(($candidato['hora']),0,-3);

/********************************************************************************
Docentes da banca
*********************************************************************************/
if(isset($candidato['orientador'])) { 
 $orientador = $docente->verDocente($candidato['orientador']);
 $orientador = $orientador[0];
 $candidato['orientador'] = $orientador['nome'];
}
if(isset($candidato['titular2'])) { 
 $titular2 = $docente->verDocente($candidato['titular2']);
 $titular2 = $titular2[0];
 $candidato['titular2'] = $titular2['nome'];
 $candidato['titular2_lotado'] = $titular2['lotado'];
}
if(isset($candidato['titular3'])) { 
 $titular3 = $docente->verDocente($candidato['titular3']);
 $titular3 = $titular3[0];
 $candidato['titular3'] = $titular3['nome'];
 $candidato['titular3_lotado'] = $titular3['lotado'];
}
if(isset($candidato['titular4'])) { 
 $titular4 = $docente->verDocente($candidato['titular4']);
 $titular4 = $titular4[0];
 $candidato['titular4'] = $titular4['nome'];
 $candidato['titular4_lotado'] = $titular4['lotado'];
}
if(isset($candidato['titular5'])) { 
 $titular5 = $docente->verDocente($candidato['titular5']);
 $titular5 = $titular5[0];
 $candidato['titular5'] = $titular5['nome'];
 $candidato['titular5_lotado'] = $titular5['lotado'];
}
if(isset($candidato['suplente1'])) { 
 $suplente1 = $docente->verDocente($candidato['suplente1']);
 $suplente1 = $suplente1[0];
 $candidato['suplente1'] = $suplente1['nome'];
 $candidato['suplente1_lotado'] = $suplente1['lotado'];
}
if(isset($candidato['suplente2'])) { 
 $suplente2 = $docente->verDocente($candidato['suplente2']);
 $suplente2 = $suplente2[0];
 $candidato['suplente2'] = $suplente2['nome'];
 $candidato['suplente2_lotado'] = $suplente2['lotado'];
}

//Variáveis complementares para candidato 
$candidato['hoje'] = "São Paulo, " . date('d') . " de " . $mes[date('n')] . " de " . date('Y');
$candidato['departamento'] = "Departamento de " . $candidato['departamento'];

//MAtrizes para docentes externos e internos
$docentes_externos=array();
$docentes_internos=array();
($orientador['docente_usp']=='nao')? array_push($docentes_externos,$orientador) :array_push($docentes_internos,$orientador);
($titular2['docente_usp']=='nao')? array_push($docentes_externos,$titular2) :array_push($docentes_internos,$titular2);
($titular3['docente_usp']=='nao')? array_push($docentes_externos,$titular3) :array_push($docentes_internos,$titular3);

if(isset($titular4))
	($titular4['docente_usp']=='nao')? array_push($docentes_externos,$titular4) :array_push($docentes_internos,$titular4);
if(isset($titular5))
($titular5['docente_usp']=='nao')? array_push($docentes_externos,$titular5) :array_push($docentes_internos,$titular5);

#($suplente1['docente_usp']=='nao')? array_push($docentes_externos,$suplente1) :array_push($docentes_internos,$suplente1);
#($suplente2['docente_usp']=='nao')? array_push($docentes_externos,$suplente2) :array_push($docentes_internos,$suplente2);

/********************************************************************************
cabeçalho em html para documentos usp 
*********************************************************************************/
$htmlFFLCH = '<html> <head> <style type="text/css">

#headerFFLCH { font-size: 14px; width: 17cm; text-align:center; font-weight:bold; font-style:italic;}
.data_hoje{ margin-left: 10cm; margin-bottom:0.8cm; }
.conteudo { margin: 1cm }
.boxSuplente {border: 1px solid; padding: 4px;}
.boxPassagem {border: 1px solid; padding: 4px; text-align: justify; }
.oficioSuplente{text-align: justify; }
.rodapeFFLCH{padding-top:3cm; text-align: center;}
p.recuo {text-indent: 0.5cm;}
.moremargin {margin-bottom: 0.15cm;}
.importante {border:1px solid; margin-top:0.3cm; margin-bottom:0.3cm; width: 15cm; font-size:12px; margin-left:0.5cm;}
.negrito {font-weight: bolder;}
.justificar{text-align: justify;}
table { background #fff; border-collapse: collapse; }
tr, td { border: 1px #000 solid; padding: 3 }
body{ margin-top: -2.1cm; margin-bottom: -2.1cm; font-family: DejaVu Sans, sans-serif; font-size: 12px; }
#footer {
  position: fixed;
  bottom: -1cm;
  left: 0px;
  right: 0px;
  text-align: center;
  border-top: 1px solid gray;
  width: 18.5cm;
  height: 100px;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head> 
<body><div  class="conteudo"> ';
$cabecalhoFFLCH = '
		<div id="headerFFLCH" >
		<table border="0" padding="0">
		<tr>
   	 <td width="2cm"> <img src="../../images/fflch.gif" width="95%"/> </td> 
			<td width="14cm"> <center style="font-style:normal; font-size:17px"> Universidade de São Paulo  <br /> 
			Faculdade de Filosofia, Letras e Ciências Humanas  <br /> 
		 </center>
		</td>
		</tr>
 	 </table>
	</div>';









