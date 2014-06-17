<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$obj_area = new Area;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['code_area'])) {
	$area = $obj_area->verArea($_GET['code_area']);
	if(!$area) die("Área não cadastrada");
}


if(!empty($_POST)){ 
	$obj_area->alterarArea($_POST,$_GET['code_area']);
	header('location:verAreas.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="../js/jquery1.7.1.js"></script>
	<script type="text/javascript" src="../js/custom/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>
	<link rel="stylesheet" href="../js/custom/css/start/jquery-ui-1.8.17.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title></title>
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
	<form action="alterarArea.php?code_area=<?php echo $_GET['code_area'] ?>" method="POST">
	<?php foreach ($area as $dados) { ?>

<label>Nome da Área: </label>  
<input type="text" class="requerido" size="50" name="nome_area"  value="<?php echo $dados['nome_area']; ?>" /> 

<label>Coordenador: </label>  
<input type="text" class="requerido" size="50" name="coordenador"  value="<?php echo $dados['coordenador']; ?>"/> 

	<label> Departamento </label>
<select name="departamento"> 
  <option <?php if($dados['departamento']=='Antropologia') echo 'selected="selected"'; ?> value="Antropologia">Antropologia</option>

  <option <?php if($dados['departamento']=='Ciência Política') echo 'selected="selected"'; ?> value="Ciência Política">Ciência Política</option>

  <option <?php if($dados['departamento']=='Diversitas') echo 'selected="selected"'; ?> value="Diversitas">Diversitas</option>

  <option <?php if($dados['departamento']=='Filosofia') echo 'selected="selected"'; ?> value="Filosofia">Filosofia</option>

  <option <?php if($dados['departamento']=='Geografia') echo 'selected="selected"'; ?> value="Geografia">Geografia</option>

  <option <?php if($dados['departamento']=='História') echo 'selected="selected"'; ?> value="História">História</option>

  <option <?php if($dados['departamento']=='Letras Clássicas e Vernáculas') echo 'selected="selected"'; ?>value="Letras Clássicas e Vernáculas">Letras Clássicas e Vernáculas</option>

  <option <?php if($dados['departamento']=='Letras Modernas') echo 'selected="selected"'; ?> value="Letras Modernas">Letras Modernas</option>

  <option <?php if($dados['departamento']=='Letras Orientais') echo 'selected="selected"'; ?> value="Letras Orientais">Letras Orientais</option>

  <option <?php if($dados['departamento']=='Linguística') echo 'selected="selected"'; ?> value="Linguística">Linguística</option>

  <option <?php if($dados['departamento']=='Sociologia') echo 'selected="selected"'; ?> value="Sociologia">Sociologia</option>

  <option <?php if($dados['departamento']=='Teoria Literária e Literatura Comparada') echo 'selected="selected"'; ?> value="Teoria Literária e Literatura Comparada">Teoria Literária e Literatura Comparada</option>
</select>
 
	<?php } ?>
	<br />
	<input type="submit" value="Aplicar Alterações" >
	</form>
</div>

	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
