<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$obj_sala = new Sala;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();

if(!empty($_POST)){
	$configdocs->inserir($_POST); 
	header('location:proximasDefesas.php');
}

if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title></title>
</head>

<body>

<div id="wrapper">
	<div id="header">
	<?php echo $info[0]['sitename']; ?>
	</div>

	<div id="leftsidebar">
	<?php include('./menu.php'); ?>
	</div>

<div id="bodycontent">
 <div style=" font-size:12px; ">  
		<b>Instruções de estilo:</b> <br>
		 &#60;br&#62;: quebra de linha <br>
		 &#60;b&#62; e &#60;/b&#62;: determina qual parte do texto ficará em negrito <br>
		 &#60;center&#62; e &#60;/center&#62;: determina qual parte do texto ficará centralizada <br>
		 &#60;hr&#62; : cria linha horizontal <br>
		 &#60;i&#62; e &#60;/i&#62;: determina qual parte do texto ficará em itálico <br>
		 &#60;u&#62; e &#60;/u&#62;: determina qual parte do texto ficará sublinhado <br>
		 &#60;p&#62; e &#60;/p&#62;: cria uma parágrafo <br>
	</div> <br> <br>
	<form action="./ConfigDocs.php" method="POST">

	<label>Nome do sistema</label> 
	<input type="text" name="sitename" value="<?php print $info[0]['sitename']; ?>" />   <br>

	<label>Rodapé do sistema</label> 
	<input type="text" name="rodape_site" value="<?php echo $info[0]['rodape_site']; ?>" /> <br>

	<label>Rodapé (ofício titular, suplente e declaração)</label>  
	<textarea rows="10" cols="70" name="rodape_oficios"><?php  echo $info[0]['rodape_oficios']; ?></textarea> <br><br>

	<label>Mensagem Importante no Ofício dos titulares</label>  
	<textarea rows="10" cols="70" name="importante_oficio"><?php  echo $info[0]['importante_oficio']; ?></textarea> <br><br>

	<label>Regimento - Artigo 95 no Ofício dos titulares</label>  
	<textarea rows="10" cols="70" name="regimento"><?php  echo $info[0]['regimento']; ?></textarea> <br><br>

	<label>Ofício Suplente </label>  
	<textarea rows="10" cols="70" name="oficio_suplente"><?php  echo $info[0]['oficio_suplente']; ?></textarea> 
	<div class="legenda">Token de substituição: %data_oficio_suplente, %nome_sala, %predio </div> 
	
	<label>Declaração de participação</label>  
	<textarea rows="10" cols="70" name="declaracao"><?php  echo $info[0]['declaracao']; ?></textarea>
	<div class="legenda">Token de substituição: %docente_nome, %nivel, %candidato_nome, %titulo, %area, %orientador </div> 
	
	<label><i> Valores para diárias de professor externo </label>
	<table cellpadding="5">
		<tr>
			<td>Diária simples: <input class="diaria" type="text" size="6" name="diaria_simples" value="<?php  echo $info[0]['diaria_simples']; ?>" /> </td>
			<td>Diária Completa: <input class="diaria" type="text" size="6" name="diaria_completa" value="<?php  echo $info[0]['diaria_completa']; ?>" /> </td>
			<td>2 diárias: <input class="diaria" type="text" size="6" name="duas_diarias" value="<?php  echo $info[0]['duas_diarias']; ?>"  /> </td></i>
	</table> <br>

	<label><i> Valores para diárias PROAP </label>
	<table cellpadding="5">
		<tr>
			<td>Diária sem pernoite: <input class="diaria" type="text" size="6" name="diaria_sem_pernoite" value="<?php  echo $info[0]['diaria_sem_pernoite']; ?>" /> </td>
			<td>Diária com pernoite: <input class="diaria" type="text" size="6" name="diaria_com_pernoite" value="<?php  echo $info[0]['diaria_com_pernoite']; ?>" /> </td>
			<td>2 diárias: <input class="diaria" type="text" size="6" name="duas_diarias_proap" value="<?php  echo $info[0]['duas_diarias_proap']; ?>"  /> </td></i>
	</table> <br>

	<label>Agência de Viagens </label>  
	<textarea rows="10" cols="70" name="agencia_viagem"><?php  echo $info[0]['agencia_viagem']; ?></textarea> <br> <br>

	<label>Ofício Agência de Viagens </label>  
	<textarea rows="10" cols="70" name="agencia_texto"><?php  echo $info[0]['agencia_texto']; ?></textarea> <br><br>

	<label> Faturar para: Agência de Viagens </label>  
	<input type="text" name="faturar_para" value="<?php echo $info[0]['faturar_para']; ?>" />  <br>

	<label> E-mails para docente </label>  
	<textarea rows="10" cols="70" name="mail_docente"><?php  echo $info[0]['mail_docente']; ?></textarea> 
	<div class="legenda">Token de substituição: %docente_nome, %candidato_nome, %data_defesa, %local_defesa </div> <br>

	<label> Observação passagem </label>  
	<textarea rows="10" cols="70" name="obs_passagem"><?php  echo $info[0]['obs_passagem']; ?></textarea> <br><br>

	<label> Cabeçalho da compra via auxílo </label>  
	<textarea rows="10" cols="70" name="header_auxilio"><?php  echo $info[0]['header_auxilio']; ?></textarea> <br><br>

	<label> CAPES/PROAP </label>  
	<textarea rows="10" cols="70" name="capes_proap"><?php  echo $info[0]['capes_proap']; ?></textarea> <br><br>

	<br />
	<input type="submit" value="Salvar" >
	</form>
</div>

	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
