<?php 
header("Content-type: text/html;charset=utf-8");
require('config.php');

/*COLOCAR RESTRIÇÃO PARA ADMINISTRADORES?*/
//if($status != 1) 	die('Você não possui acesso a esta área');

$objeto_docente = new Docente;

$resultados = $objeto_docente->BuscaDocenteNome(mb_strtoupper($_GET['term'],'UTF-8'));
$row = array();
$return = array();

if (count($resultados)>0) {
	foreach ($resultados as $docentes) {
		foreach($docentes as $campo=>$value){
			if(strcasecmp($campo,'id_docente')==0) {
				$row['id'] = $value;
			}
			else if(strcasecmp($campo,'nome')==0) {
				$row['value'] = $value;
			}
		}
	array_push($return,$row);
	}
}

echo json_encode($return);

?>

