<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$docente = new Docente;
$obj_candidato =  new Candidato;
$status = $user->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');
require('./pdfs/loadCandidato.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>

	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title> </title>
</head>

<body>
<div id="wrapper">

<div id="header">
	<?php echo $info[0]['sitename']; ?>
</div>

<div id="leftsidebar">
	<?php include('menu.php'); ?>
</div>

<div id="bodycontent">
<div id="candidato"> 
<h3>Candidato: <?php echo $candidato['nome']; ?> </h3>
<p>Defesa de: <?php echo $candidato['nivel']; ?></p> 
<p>Programa: <?php echo $candidato['nome_area']; ?>  </p> 
<p>Defesa: <?php echo $candidato['data_placa']; ?>  </p> <br>


<h3> Banca </h3>

<table class="table" cellspacing='0'>
	<tr>
		<th>Nome</th>
		<th>Tipo</th>
        <th>Ofícios titulares</th>
        <th>Ofício suplentes</th>
        <th>Declaração de Participação</th>
	</tr>

    <tr>
        <td><?php echo $orientador['nome'];?></td>
        <td> Titular </td>
        <td> <a href="./pdfs/OficioTitularPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$orientador['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> #  </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$orientador['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

    <tr>
        <td><?php echo $titular2['nome'];?></td>
        <td> Titular </td>
        <td> <a href="./pdfs/OficioTitularPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular2['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> # </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular2['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

    <tr>
        <td><?php echo $titular3['nome'];?></td>
        <td> Titular </td>
        <td> <a href="./pdfs/OficioTitularPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular3['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> # </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular3['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

<?php 
if($candidato['nivel'] == 'Doutorado') { ?> 

    <tr>
        <td><?php echo $titular4['nome'];?></td>
        <td> Titular </td>
        <td> <a href="./pdfs/OficioTitularPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular4['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> #  </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular4['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

    <tr>
        <td><?php echo $titular5['nome'];?></td>
        <td> Titular </td>
        <td> <a href="./pdfs/OficioTitularPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular5['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> #  </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$titular5['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

<?php } ?>

    <tr>
        <td><?php echo $suplente1['nome'];?></td>
        <td> Suplente </td>
        <td> #</td>
        <td> <a href="./pdfs/OficioSuplentePorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$suplente1['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$suplente1['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

    <tr>
        <td><?php echo $suplente2['nome'];?></td>
        <td> Suplente </td>
        <td> # </td>
        <td> <a href="./pdfs/OficioSuplentePorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$suplente2['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
        <td> <a href="./pdfs/declaracaoPorMembro.php<?php echo '?id_candidato='.$candidato['id_candidato'].'&membro='.$suplente2['id_docente']; ?>"> <img src="../images/pdf.png"></a> </td>
    </tr>

</table>

<br>
<h3>Documentos Gerais</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Tipo do documento</th>
		<th> Gerar</th>
	</tr>
	<tr>
		<td>Documento Zero </td>
		<td> <a href="./pdfs/zero.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
<tr>
		<td>Placa</td>
		<td> <a href="./pdfs/placa.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
	<tr>
		<td>Etiquetas </td>
		<td> <a href="./pdfs/etiquetas.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
	<tr>
		<td> Ofícios titulares </td>
		<td> <a href="./pdfs/OficioTitular.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
	<tr>
		<td> Ofício suplentes </td>
		<td> <a href="./pdfs/OficioSuplente.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
	<tr>
		<td> Declaração de Participação </td>
		<td> <a href="./pdfs/declaracao.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a> </td>
	</tr>
	<tr>
		<td> Recibos de remessa de documentos para docentes USP</td>
		<td> <a href="./pdfs/remessa.php?id_candidato=<?php echo $candidato['id_candidato'] ?>"><img src="../images/pdf.png"></a>  </td>
	</tr>
</table>

<br>
<h3>Recibo de diária para docentes externos</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Ida</th>
		<th>Volta</th>		
		<th>Origem</th>
		<th>Diária</th>
		<th>Gerar recibo</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2diaria) { ?>	
<form action="./ReciboExterno.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2diaria['nome']; ?> </td>
		<td> <input  type="text" size="6" name="ida" /> </td>
		<td> <input  type="text" size="6" name="volta" /> </td>
		<td> <input  type="text" size="6" name="origem" /> </td>
		<td> 	<select name="diaria"> 
						<option value="diaria_simples" selected="selected"> Simples </option>
						<option value="diaria_completa"> Completa </option>
						<option value="duas_diarias"> 2 diárias </option>
					</select>  </td>
		<td> <input type="submit" value="Recibo" > </td>
	</tr>
	<input type="hidden" name="nome_docente" value="<?php echo $docente2diaria['nome']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2diaria['email']; ?>" />
	<input type="hidden" name="nusp_docente" value="<?php echo $docente2diaria['n_usp']; ?>" />		
	</form>
<?php } ?>
</table>

<br>
<h3>PROEX</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Importância recebida</th>
		<th>Período</th>	
		<th>Valor remuneração</th>	
		<th>Outros</th>	
		<th>Líquido</th>

		<th>Gerar documento</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2proex) { ?>
<form action="./pdfs/proex.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2proex['nome']; ?> </td>
		<td> <input type="text" size="6" name="importancia" /> </td>
		<td> <input type="text" size="6" name="periodo" /> </td>
		<td> <input type="text" size="6" name="valor" /> </td>
		<td> Tipo: <br> <input type="text" size="4" name="outro_tipo" /> <br>
				 Valor: <br> <input type="text" size="4" name="outro_valor" />	 </td>
		<td> <input type="text" size="6" name="liquido" /> </td>
		<td> <input type="submit" size="4"  value="Gerar" > </td>
	</tr>

	<?php 
		$docente2proex['completo'] = " ";
		if(!empty($docente2proex['endereco'])) $docente2proex['completo'] .= $docente2proex['endereco'] . " " ;
		if(!empty($docente2proex['bairro'])) $docente2proex['completo'] .= $docente2proex['bairro'] . " ";
		if(!empty($docente2proex['cidade'])) $docente2proex['completo'] .= $docente2proex['cidade'] . " ";
		if(!empty($docente2proex['estado'])) $docente2proex['completo'] .= $docente2proex['estado'] . " ";
		if(!empty($docente2proex['cep'])) $docente2proex['completo'] .= $docente2proex['cep'];
	?>

	<input type="hidden" name="nome_docente" value="<?php echo $docente2proex['nome']; ?>" />
	<input type="hidden" name="telefone_docente" value="<?php echo $docente2proex['telefone']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2proex['email']; ?>" />	
	<input type="hidden" name="cpf_docente" value="<?php echo $docente2proex['cpf']; ?>" />	
	<input type="hidden" name="documento" value="<?php echo $docente2proex['documento']; ?>" />	
	<input type="hidden" name="endereco" value="<?php echo $docente2proex['completo'] ?>" />	
	</form>
<?php } ?>
</table>

<br>
<h3>Recibo de diárias - PROAP</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Ano PROAP</th>
		<th>N. Diárias</th>	
		<th>Origem </th>
		<th>Chegada</th>	
		<th>Saída</th>
		<th>Valor</th>
		<th>Valor por extenso </th>	
		<th>Gerar documento</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2rd) { ?>
<form action="./pdfs/proap.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2rd['nome']; ?> </td>
		<td> <input type="text" size="2" name="ano" /> </td>
	  <td> <input type="text" size="1" name="diaria_proap" />  </td>
		<td> <input type="text" size="6" name="origem" /> </td>
		<td> <input type="text" size="6" name="chegada" /> </td>
		<td> <input type="text" size="6" name="saida" /> </td>
		<td> <input type="text" size="1" name="valor_proap" /> </td>
		<td> <input type="text" size="6" name="extenso" /> </td>
		<td> <input type="submit" size="4"  value="Gerar" > </td>
	</tr>

	<?php 
		$docente2rd['completo'] = " ";
		if(!empty($docente2rd['endereco'])) $docente2rd['completo'] .= $docente2rd['endereco'] . " - ";
		if(!empty($docente2rd['bairro'])) $docente2rd['completo'] .= $docente2rd['bairro'] . " - ";
		if(!empty($docente2rd['cidade'])) $docente2rd['completo'] .= $docente2rd['cidade'] . " - ";
		if(!empty($docente2rd['estado'])) $docente2rd['completo'] .= $docente2rd['estado'] . " - ";
		if(!empty($docente2rd['cep'])) $docente2rd['completo'] .= $docente2rd['cep'] ;
	?>

	<input type="hidden" name="nome_docente" value="<?php echo $docente2rd['nome']; ?>" />
	<input type="hidden" name="telefone_docente" value="<?php echo $docente2rd['telefone']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2rd['email']; ?>" />	
	<input type="hidden" name="cpf_docente" value="<?php echo $docente2rd['cpf']; ?>" />	
	<input type="hidden" name="documento" value="<?php echo $docente2rd['documento']; ?>" />	
	<input type="hidden" name="lotado" value="<?php echo $docente2rd['lotado']; ?>" />	
	<input type="hidden" name="endereco" value="<?php echo $docente2rd['completo']; ?>" />	
	
	</form>
<?php } ?>
</table>

<br>
<h3>Requisição de passagem aérea</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Ida <br> (dia - horário) </th>
		<th>Volta <br> (dia - horário)</th>		
		<th>Trajeto</th>
		<th>n. requisição</th>
		<th>Gerar documento</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2req) { ?>
<form action="./pdfs/passagem.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2req['nome']; ?> </td>
		<td> <input  type="text" size="6" name="ida" /> </td>
		<td> <input type="text" size="6" name="volta" /> </td>
		<td> <input  type="text" size="6" name="trajeto" /> </td>
		<td> <input type="text" size="6" name="requisicao" />	 </td>
		<td> <input type="submit" size="4"  value="Passagem" > </td>
	</tr>
	<input type="hidden" name="nome_docente" value="<?php echo $docente2req['nome']; ?>" />
	<input type="hidden" name="telefone_docente" value="<?php echo $docente2req['telefone']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2req['email']; ?>" />	
	</form>
<?php } ?>
</table>

<br>
<h3>Passagem aérea - Compra via auxílio</h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Partida</th>
		<th>Retorno</th>		
		<th>Itinerário</th>
		<th>Processo/Pregão</th>
		<th>Gerar documento</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2reqAux) { ?>
<form action="./pdfs/passagemAuxilio.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2reqAux['nome']; ?> </td>
		<td> <input  type="text" size="6" name="partida" /> </td>
		<td> <input  type="text" size="6" name="retorno" /> </td>
		<td> <input  type="text" size="6" name="itinerario" /> </td>
		<td> <input type="text" size="6" name="processo" />	 </td>
		<td> <input type="submit" size="4"  value="Gerar" > </td>
	</tr>
	<input type="hidden" name="nome_docente" value="<?php echo $docente2reqAux['nome']; ?>" />
	<input type="hidden" name="telefone_docente" value="<?php echo $docente2reqAux['telefone']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2reqAux['email']; ?>" />	
	</form>
<?php } ?>
</table>

<br>
<h3>E-mails para docente </h3>
<table class="table" cellspacing='0'>
	<tr>
		<th>Docente</th>
		<th>Gerar documento</th> 
	</tr>
<?php foreach ($docentes_externos as $docente2mail) { ?>
<form action="./emails.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
	<tr> 
 		<td> <?php echo $docente2mail['nome']; ?> </td>
		<td> <input type="submit" size="4"  value="E-mail" > </td> 
	</tr>
	<input type="hidden" name="nome_docente" value="<?php echo $docente2mail['nome']; ?>" />
	<input type="hidden" name="n_usp" value="<?php echo $docente2mail['n_usp']; ?>" />
	<input type="hidden" name="email_docente" value="<?php echo $docente2mail['email']; ?>" />
	<input type="hidden" name="pis" value="<?php echo $docente2mail['pis_pasep']; ?>" />	

	</form>
<?php } ?>
</table>

<br>

<!--
<br><br> Falta implentar:
<h4> <a href="#"><img src="../images/transferir.gif" height="18px"></a> Enviar para Drupal</h4>
-->
</div> <!-- Fecha id candidato -->
</div> <!-- Fecha o id wrapper -->

<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
</div>
</div>

</body>
</html>
