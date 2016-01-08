<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$docente = new Docente;
$candidato = new Candidato;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_POST['docente'])){ 
	header("location:alterarDocente.php?id_docente={$_POST['docente']}");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title> </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>

	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />

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
<form action="buscarDocente.php" method="POST">
	
<label>Docente: </label> 
<input class="autocomplete requerido apagar" type="text" name="docente"/>  

<input id="" type="submit" size="20" value="Editar" >

<input type="hidden" id="docente" name="docente">
</form>

</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>



<?php
if(isset($_GET['alterado']) && $_GET['alterado'] == 'sim') {
	echo "<script LANGUAGE=\"Javascript\" > alert(\"Alterações realizadas com sucesso!\"); 
   self.location = 'buscarDocente.php';
   </script>";
}
