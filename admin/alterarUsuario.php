<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['codpes'])) {
	$user = $usuarios->verUsuario($_GET['codpes']);
	if(!$user) die("Número USP não cadastrado");
}


if(!empty($_POST)){
	$usuarios->alterarUsuario($_POST,$_GET['codpes']);
	header('location:verUsuarios.php');
}

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
	<?php include('menu.php'); ?>
	</div>

<div id="bodycontent">
<form action="alterarUsuario.php?codpes=<?php echo $_GET['codpes'] ?>" method="POST">
<?php foreach ($user as $dados) { ?>

<label>Número USP </label> 
<input type="text" readonly="true"  name="codpes" value="<?php echo $dados['codpes']; ?>" />  

<label>Nome</label> 
<input type="text" name="nome" value="<?php echo $dados['nome']; ?>" />  

<label>Senha: </label> 
<input type="password"  name="password"> Deixe em branco para manter a senha atual
 
<label>Email: </label>
<input type="text"  name="email" value="<?php echo $dados['email']; ?>" /> 
 
<?php } ?>
<br />
<input type="submit" value="Aplicar Alterações" >
</form>
</div>

	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
