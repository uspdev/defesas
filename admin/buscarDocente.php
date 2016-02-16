<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$docente = new Docente;
$candidato = new Candidato;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();

if($status != 2 && $status != 1) 
  die('Você não possui acesso a esta área');

if(!empty($_POST['docente_id'])){ 
  header("location:alterarDocente.php?id_docente={$_POST['docente_id']}");
}


?>

<!DOCTYPE html>
<html>
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
<form action="buscarDocente.php" method="post" enctype="multipart/form-data">
	
  <label>Docente: </label> 
  <input class="autocomplete requerido apagar" type="text" id='docente' name="docente"/>  
  <input type="hidden" id="docente_id" name="docente_">

  <input id="submit" name="submit" type="submit" size="20" value="Editar" >

</form>

</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
