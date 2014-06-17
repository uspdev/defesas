<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$docente = new Docente;
$candidato = new Candidato;
$area = new Area;
$sala = new Sala;
$status = $usuarios->verificarStatus();
$todas_salas = $sala->listarSalas();
$todas_areas = $area->listarAreas();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');


if(!empty($_POST)){ 
 if($_POST['nivel'] == 'Mestrado') {
  unset($_POST['titular4']);
  unset($_POST['titular5']);
 }
	$candidato->cadastrarCandidato($_POST);
	header('location:proximasDefesas.php');
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title> </title>
	<script type="text/javascript" src="../js/jquery1.7.1.js"></script>
	<script type="text/javascript" src="../js/custom/js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="../js/defesas.js"></script>
	<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>
	<link rel="stylesheet" href="../js/custom/css/start/jquery-ui-1.8.17.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />

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
<form action="criarCandidato.php" method="POST">
	
<label>Nome Completo </label> 
<input class="requerido" type="text" name="nome" /> 

<label>Número USP </label> 
<input class="requerido campomenor" type="text" name="codpes" />  

<label>Sexo</label>
<select name="sexo_pessoa"> 
	<option value="Masculino" selected="selected"> Masculino </option>
	<option value="Femininio"> Feminino </option>
</select>   

<label>Nível</label> 
<select id="nivel" name="nivel"> 
	<option value="Mestrado" selected="selected"> Mestrado </option>
	<option value="Doutorado"> Doutorado </option>
</select>  

<label>Título da Tese</label> 
<input class="requerido" type="text" name="titulo" />  

<label>Programa</label> 
<select class='requerido' name="area"> 
	<?php foreach ($todas_areas as $value) { ?>
	<option value="<?php echo $value['code_area']; ?>"> <?php echo $value['nome_area']; ?> </option>
<?php } ?>
</select> 

<label>Data</label> 
<input class="requerido campodata" id="datepicker" type="text" name="data" maxlength="4"	/> 

<label>Horário</label> 
<select name="horario">
<option value="08:00">08:00</option>
<option value="08:30">08:30</option>
<option value="09:00">09:00</option>
<option value="09:30">09:30</option>
<option value="10:00">10:00</option>
<option value="10:30">10:30</option>
<option value="11:00">11:00</option>
<option value="11:30">11:30</option>
<option value="12:00">12:00</option>
<option value="12:30">12:30</option>
<option value="13:00">13:00</option>
<option value="13:30">13:30</option>
<option value="14:00">14:00</option>
<option value="14:30">14:30</option>
<option value="15:00">15:00</option>
<option value="15:30">15:30</option>
<option value="16:00">16:00</option>
<option value="16:30">16:30</option>
<option value="17:00">17:00</option>
<option value="17:30">17:30</option>
<option value="18:00">18:00</option>
<option value="18:30">18:30</option>
<option value="19:00">19:00</option>
</select>

<label>Local</label> 
<select class='requerido' name="sala"> 
	<?php foreach ($todas_salas as $value) { ?>
	<option value="<?php echo $value['code_sala']; ?>"> <?php echo $value['nome_sala']; ?> </option>
<?php } ?>
</select>

<label>Orientador</label> 
<input class="autocomplete apagar" type="text"  name="orientador"  />  

<label>Segundo Titular</label> 
<input  class="autocomplete apagar" type="text"  name="titular2" />  

<label>Terceiro Titular</label> 
<input  class="autocomplete apagar" type="text" name="titular3"  />  

<div id="oculto">
	<label>Quarto Titular</label> 
	<input class="autocomplete apagar" type="text"  name="titular4"  /> 

	<label>Quinto Titular</label> 
	<input class="autocomplete apagar" type="text" name="titular5"  />  
</div>
<label>Suplente 1</label> 
<input  class="autocomplete apagar" type="text"  name="suplente1" />  

<label>Suplente 2</label> 
<input class="autocomplete apagar" type="text" name="suplente2" /> 
 
<br />
<input id="" type="submit" value="Cadastrar" >

<input type="hidden" class="requerido2" name="orientador" id="orientador">
<input type="hidden" class="requerido2"  name="titular2" id="titular2" >
<input type="hidden" class="requerido2" name="titular3" id="titular3">
<input type="hidden" name="titular4" id="titular4">
<input type="hidden" name="titular5" id="titular5" >
<input type="hidden" class="requerido2" name="suplente1" id="suplente1">
<input type="hidden" class="requerido2" name="suplente2" id="suplente2"> 

</form>
</div>

	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
