<?php

require('../config.php');
$usuarios = new Users;
$status =  $usuarios->verificarStatus();
if($status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['codpes'])) {
	if($usuarios->apagarUsuario($_GET['codpes'])) {
		header('location:verUsuarios.php');
	}
	else {
		echo "<script LANGUAGE=\"Javascript\">  
   					self.location = 'verUsuarios.php?erro=fatal';
   			 </script>";

	}
} 
else header('location:verUsuarios.php');



