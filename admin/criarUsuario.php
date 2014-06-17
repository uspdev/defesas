<?php

require('../config.php');
$usuarios = new Users;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_POST)){
 if(empty($_POST['codpes'])) 	die('Número USP obrigatório');
	$usuarios->cadastrarUsuario($_POST);
	header('location:verUsuarios.php');
}

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
	<?php echo $info[0]['sitename']; ?>
	</div>

	<div id="leftsidebar">
	<?php include('menu.php'); ?>
	</div>

<div id="bodycontent">
<form action="criarUsuario.php" method="POST">

<label>Número USP: </label> 
<input class="campomenor" type="text" name="codpes" />  

<label>Nome completo: </label> 
<input type="text" name="nome" />  

<label>Senha: </label> 
<input type="password"  name="password">
 
<label>Email: </label>
<input type="text"  name="email"> 
<br>
<input type="submit" value="Criar Usuario" >
</form>
</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
</div>
</div>


</body>
</html>
