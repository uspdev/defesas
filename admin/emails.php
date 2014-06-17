<?php

header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$docente = new Docente;
$obj_candidato =  new Candidato;
$status = $user->verificarStatus();
$configdocs = new ConfigDocs;
$info_banco = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');
require('./pdfs/loadCandidato.php');
$info_banco[0]['mail_docente'] = str_replace('%docente_nome',$_POST["nome_docente"],$info_banco[0]['mail_docente']);
$info_banco[0]['mail_docente'] = str_replace('%candidato_nome',$candidato["nome"],$info_banco[0]['mail_docente']);
$info_banco[0]['mail_docente'] = str_replace('%data_defesa',$candidato["data_placa"],$info_banco[0]['mail_docente']);
$info_banco[0]['mail_docente'] = str_replace('%local_defesa',$candidato["nome_sala"],$info_banco[0]['mail_docente']);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title> </title>
</head>

<body>

<div id="wrapper">
	<div id="header">
		<?php echo  $info_banco[0]['sitename']; ?>
	</div>

	<div id="leftsidebar">
		<?php include('./menu.php'); ?>
	</div>

<div id="bodycontent">
 
	<p> <i> Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br </p> </i> <br>
	
	<h3> <u> Pagamento de Pró-Labore para banca de <?php echo $candidato['nivel']; ?> </u> </h3>
	<p>Candidato(a): <b> <?php echo $candidato['nome']; ?> </b> </p>
	<p><b> <?php echo $candidato['departamento']; ?> </b> </p>
	<p> Data da defesa:<b> <?php echo $candidato['data_placa']; ?> </b> </p>
	<br>
	Item(s):
	<p>Prof. Dr. <?php echo $_POST["nome_docente"]; ?> </p>
	<p>Número USP: <?php echo $_POST["n_usp"]; ?> </p>
	<p>PIS/PASEP: <?php echo $_POST["pis"]; ?> </p> 
	<br>

	<?php echo $info_banco[0]["mail_docente"]; ?> <br><br>


	 <br><br> <a href="./geraPDFs.php?id_candidato=<?php echo $candidato['id_candidato']; ?>">	Voltar </a>
</div>
	<div id="footer" class="clear">
		<?php print $info_banco[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
