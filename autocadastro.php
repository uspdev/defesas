<?php

require('config.php');
$usuarios = new Usuarios;
$status = $usuarios->verificarStatus();
if($status) die ('vc ja esta logado');


if(!empty($_POST)){
	$usuarios->cadastrarUsuario($_POST);
	header('location:index.php');
}




?>


<html>
<head> <title> posts </title> </head>
<body>
<form action="autocadastro.php" method="POST">

<label>Username: </label> <br />
<input type="text" name="username" /><br />
 
<label>Senha: </label> <br />
<input type="password"  name="senha"> <br />
 
<label>Email: </label> <br />
<input type="text"  name="email"> <br />
 
<input type="submit" value="cadastrar" >
<form>

</body>
</html>
