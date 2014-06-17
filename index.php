<?php
require('config.php'); 
$users = new Users;

$status = $users->verificarStatus();
if($status) header('location:./admin/proximasDefesas.php');


if(!empty($_POST)) {
	$log = $users->logar($_POST);  
	if($log) header('location:./admin/proximasDefesas.php');
	else header('location:./index.php'); 
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <title>Desefas</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
				<link rel="stylesheet" href="defesas.css" type="text/css" media="all" />
    </head>

<body>

<div id="wrapper" >
	<div id="header" >
	Defesas FFLCH-USP
	</div>

	<div id="leftsidebar" class='rounded-corners'>
	<form action="index.php" method="POST">

	<label>N. USP </label> 
	<input type="text" name="codpes" />
 
	<label>Senha </label> 
	<input type="password" name="password" />
 <br />
	<input type="submit" value="Logar" >
	</form>
	</div>

	<div id="bodycontent">
Sistema de Defesas - Pós-Graduação FFLCH-USP 
	</div>


	<div id="footer" class="clear">
	FFLCH
	</div>
</div>

</body>
</html>
