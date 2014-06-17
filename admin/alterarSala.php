<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$obj_sala = new Sala;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['code_sala'])) {
	$sala = $obj_sala->verSala($_GET['code_sala']);
	if(!$sala) die("Área não cadastrada");
}


if(!empty($_POST)){ 
	$obj_sala->alterarSala($_POST,$_GET['code_sala']);
	header('location:verSalas.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="../js/jquery1.7.1.js"></script>
	<script type="text/javascript" src="../js/custom/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>
	<link rel="stylesheet" href="../js/custom/css/start/jquery-ui-1.8.17.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title></title>
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
	<form action="alterarSala.php?code_sala=<?php echo $_GET['code_sala'] ?>" method="POST">
	<?php foreach ($sala as $dados) { ?>

<label>Sala: </label>  
<input type="text" class="requerido" size="50" name="nome_sala"  value="<?php echo $dados['nome_sala']; ?>" /> 

<label>Prédio: </label>  
<input type="text" class="requerido" size="50" name="predio"  value="<?php echo $dados['predio']; ?>"/> 

 
	<?php } ?>
	<br />
	<input type="submit" value="Aplicar Alterações" >
	<form>
</div>

	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
