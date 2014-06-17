<?php

require('../config.php');
$usuarios = new Users;
$sala =  new Sala;
$status =  $usuarios->verificarStatus();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['code_sala'])) {
	if($sala->apagarSala($_GET['code_sala'])) {
		header('Location:verSalas.php');
	}
	else {
		echo "<script LANGUAGE=\"Javascript\">  
   				self.location = 'verSalas.php?erro=fatal';
   			 </script>";
 	}
} 
else header('Location:verSalas.php');



