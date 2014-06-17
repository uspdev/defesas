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
	<h3> <i> Copiar esse dados e colar em corpo de e-mail para: tesourariafflch@usp.br </h3> </i> <br>
	
	<h3>Nome: <?php echo $_POST["nome_docente"]; ?> </h3> 
	<h3>N° USP: <?php echo $_POST["nusp_docente"]; ?> </h3> 
	<h3>Origem: <?php echo $_POST["origem"]; ?> </h3> 
	<h3>Ida: <?php echo $_POST["ida"]; ?> </h3> 
	<h3>Volta: <?php echo $_POST["volta"]; ?> </h3> 
	<h3>e-mail: <?php echo $_POST["email_docente"]; ?> </h3> <br>
	<p>Banca de <b> <?php echo $candidato['nome_area'] . '/' . $candidato['nivel']; ?> </b> </p>
	<p>Do(a) aluno(a) <b> <?php echo $candidato['nome']; ?> </b> </p>
	<p>Data da defesa: <b> <?php echo $candidato['data_placa']; ?> </b> </p> <br /><br />
	<?php if($_POST['diaria']=="diaria_simples") $diaria="Diária Simples";  
				else if($_POST['diaria']=="diaria_completa") $diaria="Diária Completa";
				else if($_POST['diaria']=="duas_diarias") $diaria="2 Diárias";
	?>
	<p> <b> <?php echo $diaria . ': ' . $info_banco[0][$_POST['diaria']] ?>  </b> </p> <br> <br>

	<a href="./geraPDFs.php?id_candidato=<?php echo $candidato['id_candidato']; ?>">	Voltar </a>
</div>
	<div id="footer" class="clear">
		<?php print $info_banco[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
