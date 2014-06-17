<?php

require('../config.php');
$usuarios = new Users;
$docente =  new Docente;
$status =  $usuarios->verificarStatus();
if($status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['id_docente'])) {
	if($docente->apagarDocente($_GET['id_docente'])) {	
		header('Location:verDocentes.php');
	}
	else {
		echo "<script LANGUAGE=\"Javascript\">  
   					self.location = 'verDocentes.php?erro=fatal';
   			 </script>";
 }
} 
else header('Location:verDocentes.php');



