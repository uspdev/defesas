<?php

require('../config.php');
$usuarios = new Users;
$candidato =  new Candidato;
$status =  $usuarios->verificarStatus();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['id_candidato'])) {
	$candidato->apagarCandidato($_GET['id_candidato']);
	header('location:proximasDefesas.php');
} 
else header('location:proximasDefesas.php');



