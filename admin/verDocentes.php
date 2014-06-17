<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$docente = new Docente;
$status = $user->verificarStatus();
$todos = $docente->listarDocentes();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();

if($status != 1) 	die('Você não possui acesso a esta área');


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
<h1>Docentes</h1>

<table class="table" cellspacing='0'>
<tr>
<th>Nome</th>
<th colspan="2"><center>Operações</center> </th>
<th> Última alteração </th>
</tr>

<?php foreach ($todos as $value) { ?>
<tr>
<td> <?php echo $value['nome']; ?></td>
<td> <a href="./alterarDocente.php?id_docente=<?php echo $value['id_docente'] ?>"> <img src="../images/editar.png"></a> </td>
<td> <a href="./apagarDocente.php?id_docente=<?php echo $value['id_docente'] ?>"> <img src="../images/excluir.png"></a> </td>

<?php if(isset($value['last_user'])) $ultimo = $user->verUsuario($value['last_user']);
			else $ultimo = $user->verUsuario(5385361); 
			if(isset($value['updated_at'])) {
				$modificado = explode(' ',$value['updated_at']);
				$modificado = implode('/',array_reverse(explode('-',$modificado[0]))); 
			}  
 ?>

<td> <?php echo "por: {$ultimo[0]['nome']} em: {$modificado} "; ?>  </td>

</tr>

<?php } ?>
</table>
</div>
<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
</div>
</div>

</body>
</html>


<?php
if(isset($_GET['erro']) && $_GET['erro'] == 'fatal') {
	echo "<script LANGUAGE=\"Javascript\" > alert(\"Impossível apagar! Candidatos estão cadastrados com este docente\"); 
   self.location = 'verDocentes.php';
   </script>";
}
?>

