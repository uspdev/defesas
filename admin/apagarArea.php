<?php

require('../config.php');
$usuarios = new Users;
$area =  new Area;
$status =  $usuarios->verificarStatus();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['code_area'])) {
	if($area->apagarArea($_GET['code_area']))
		header('Location:verAreas.php');
	else {
		echo "<script LANGUAGE=\"Javascript\">  
   					self.location = 'verAreas.php?erro=fatal';
   			 </script>";
	}
} 
else header('Location: index.php');



