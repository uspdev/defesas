<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$area = new Area;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_POST)){
	$area->cadastrarArea($_POST);
	header('location:verAreas.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>
	
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
<form action="criarArea.php" method="POST">

<label>Nome da Área: </label>  
<input type="text" class="requerido" size="50" name="nome_area"  /> 

<label>Coordenador: </label>  
<input type="text"  class="requerido" size="50" name="coordenador" /> 

<label> Departamento </label>
<select name="departamento"> 
  <option value="Antropologia">Antropologia</option>
  <option value="Ciência Política">Ciência Política</option>
  <option value="Diversitas">Diversitas</option>
  <option value="Filosofia">Filosofia</option>
  <option value="Geografia">Geografia</option>
  <option value="História">História</option>
  <option value="Letras Clássicas e Vernáculas">Letras Clássicas e Vernáculas</option>
  <option value="Letras Modernas">Letras Modernas</option>
  <option value="Letras Orientais">Letras Orientais</option>
  <option value="Linguística">Linguística</option>
  <option value="Sociologia">Sociologia</option>
  <option value="Teoria Literária e Literatura Comparada">Teoria Literária e Literatura Comparada</option>
</select>
 
<br />
<input type="submit" value="Cadastrar Programa" >
</form>
</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
