<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$obj_docente = new Docente;
$obj_candidato =  new Candidato;
$status = $usuarios->verificarStatus();

$area = new Area;
$todas_areas = $area->listarAreas();

$sala = new Sala;
$todas_salas = $sala->listarSalas();

$configdocs = new ConfigDocs;
$info = $configdocs->ver();

if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_GET['id_candidato'])) {
	$candidato = $obj_candidato->verCandidato($_GET['id_candidato']);
	if(!$candidato) die("Candidato não cadastrado");
}


if(!empty($_POST)){ 
	if($_POST['nivel']=='Mestrado') {
		$_POST['titular4'] = NULL;
		$_POST['titular5'] = NULL;
	}
	$obj_candidato->alterarCandidato($_POST,$_GET['id_candidato']); 
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
<form id="alterarCandidato" action="alterarCandidato.php?id_candidato=<?php echo $_GET['id_candidato'] ?>" method="POST">
<?php foreach ($candidato as $dados) {  ?>
	
<label>Nome Completo </label> 
<input class="requerido" type="text" name="nome" value="<?php echo $dados['nome']; ?>" /> 

<label>Número USP </label> 
<input class="requerido" type="text" name="codpes" size="4" value="<?php echo $dados['codpes']; ?>" /> 

<label> Sexo </label>
<select name="sexo_pessoa"> 
  <option value="Masculino" <?php if($dados['sexo_pessoa']=='Masculino') echo 'selected="selected"'; ?> >Masculino</option>
  <option value="Feminino" <?php if($dados['sexo_pessoa']=='Feminino') echo 'selected="selected"'; ?> >Feminino</option>
</select> <br /> 

<label> Nível </label>
<select id="nivel" name="nivel">
 <option value="Mestrado" <?php if($dados['nivel']=='Mestrado') echo 'selected="selected"'; ?> >Mestrado</option>
  <option value="Doutorado" <?php if($dados['nivel']=='Doutorado') echo 'selected="selected"'; ?> >Doutorado</option>
</select> 


<label>Título da Tese</label> 
<input class="requerido" type="text" name="titulo" size="60" value="<?php echo $dados['titulo']; ?>" />  

<label>Área</label> 
<select name="area"> 
<?php foreach ($todas_areas as $value) { ?>
	<option value="<?php echo $value['code_area'];?>"
 <?php if($dados['area'] == $value['code_area']) echo 'selected="selected"' ?> > 
 <?php echo $value['nome_area']; ?> </option>
<?php } ?>
</select> 

<?php 
$aux = array();
$aux = explode(' ',$dados['data_horario']); 
$aux['hora'] = explode(':',$aux[1]);
$dados['hora'] = $aux['hora'][0] . ':' . $aux['hora'][1];
$dados['data'] = implode('/',array_reverse(explode('-',$aux[0])));
?>

<label>Data</label> 
<input class="requerido campodata" id="datepicker" type="text" name="data" size="4" maxlength="10" value="<?php echo $dados['data']; ?>" />  

<label>Horário</label> 
<select name="horario">
<option value="08:00" <?php if($dados['hora'] == "08:00") echo 'selected="selected"'?> >08:00</option>
<option value="08:30" <?php if($dados['hora'] == "08:30") echo 'selected="selected"'?> >08:30</option>
<option value="09:00" <?php if($dados['hora'] == "09:00") echo 'selected="selected"'?> >09:00</option>
<option value="09:30" <?php if($dados['hora'] == "09:30") echo 'selected="selected"'?> >09:30</option>
<option value="10:00" <?php if($dados['hora'] == "10:00") echo 'selected="selected"'?> >10:00</option>
<option value="10:30" <?php if($dados['hora'] == "10:30") echo 'selected="selected"'?> >10:30</option>
<option value="11:00" <?php if($dados['hora'] == "11:00") echo 'selected="selected"'?> >11:00</option>
<option value="11:30" <?php if($dados['hora'] == "11:30") echo 'selected="selected"'?> >11:30</option>
<option value="12:00" <?php if($dados['hora'] == "12:00") echo 'selected="selected"'?> >12:00</option>
<option value="12:30" <?php if($dados['hora'] == "12:30") echo 'selected="selected"'?> >12:30</option>
<option value="13:00" <?php if($dados['hora'] == "13:00") echo 'selected="selected"'?> >13:00</option>
<option value="13:30" <?php if($dados['hora'] == "13:30") echo 'selected="selected"'?> >13:30</option>
<option value="14:00" <?php if($dados['hora'] == "14:00") echo 'selected="selected"'?> >14:00</option>
<option value="14:30" <?php if($dados['hora'] == "14:30") echo 'selected="selected"'?> >14:30</option>
<option value="15:00" <?php if($dados['hora'] == "15:00") echo 'selected="selected"'?> >15:00</option>
<option value="15:30" <?php if($dados['hora'] == "15:30") echo 'selected="selected"'?> >15:30</option>
<option value="16:00" <?php if($dados['hora'] == "16:00") echo 'selected="selected"'?> >16:00</option>
<option value="16:30" <?php if($dados['hora'] == "16:30") echo 'selected="selected"'?> >16:30</option>
<option value="17:00" <?php if($dados['hora'] == "17:00") echo 'selected="selected"'?> >17:00</option>
<option value="17:30" <?php if($dados['hora'] == "17:30") echo 'selected="selected"'?> >17:30</option>
<option value="18:00" <?php if($dados['hora'] == "18:00") echo 'selected="selected"'?> >18:00</option>
<option value="18:30" <?php if($dados['hora'] == "18:30") echo 'selected="selected"'?> >18:30</option>
<option value="19:00" <?php if($dados['hora'] == "19:00") echo 'selected="selected"'?> >19:00</option>
</select>


<label>Local</label> 
<select name="sala"> 
<?php foreach ($todas_salas as $value) { ?>
	<option value="<?php echo $value['code_sala'];?>"
 <?php if($dados['sala'] == $value['code_sala']) echo 'selected="selected"' ?> > 
 <?php echo $value['nome_sala']; ?> </option>
<?php } ?>
</select> 


<?php 
	$orientador = $obj_docente->verDocente($dados['orientador']); 
	$titular2 = $obj_docente->verDocente($dados['titular2']); 
	$titular3 = $obj_docente->verDocente($dados['titular3']); 
	$suplente1 = $obj_docente->verDocente($dados['suplente1']); 
	$suplente2 = $obj_docente->verDocente($dados['suplente2']); 
  if($dados['nivel']=='Doutorado') {
		$titular4 = $obj_docente->verDocente($dados['titular4']); 
		$titular5 = $obj_docente->verDocente($dados['titular5']); 
	}
?> 
<label>Orientador</label> 
<input class="autocomplete apagar" type="text" name="orientador" value="<?php echo $orientador[0]['nome']; ?>"/> 

<label>Segundo Titular</label> 
<input class="autocomplete apagar" type="text"  name="titular2" value="<?php echo $titular2[0]['nome']; ?>"/> 

<label>Terceiro Titular</label> 
<input class="autocomplete apagar" type="text" name="titular3" value="<?php echo $titular3[0]['nome']; ?>" />  

<div id="oculto" >
	<label>Quarto Titular</label> 
	<input class="autocomplete  apagar" type="text"  name="titular4" value="<?php if(isset($titular4[0]['nome'])) echo $titular4[0]['nome']; ?>" />  

	<label>Quinto Titular</label> 
	<input class="autocomplete  apagar" type="text" name="titular5" value="<?php if(isset($titular5[0]['nome'])) echo $titular5[0]['nome']; ?>"/>  
</div>
<label>Suplente 1</label> 
<input class="autocomplete apagar" type="text"  name="suplente1"value="<?php echo $suplente1[0]['nome']; ?>"/>  

<label>Suplente 2</label> 
<input class="autocomplete apagar" type="text" name="suplente2" value="<?php echo $suplente2[0]['nome']; ?>"/>  
 
<br />
<input type="submit" value="Aplicar Alterações" >

<input type="hidden" class="requerido2" id="orientador" name="orientador" value="<?php echo $orientador[0]['id_docente']; ?>">
<input type="hidden" class="requerido2" id="titular2" name="titular2" value="<?php echo $titular2[0]['id_docente']; ?>">
<input type="hidden" class="requerido2" id="titular3" name="titular3" value="<?php echo $titular3[0]['id_docente']; ?>">

<input type="hidden" id="titular4" name="titular4" value="<?php if(isset($titular4[0]['id_docente'])) echo $titular4[0]['id_docente']; ?>" >
<input type="hidden" id="titular5" name="titular5" value="<?php if(isset($titular5[0]['id_docente'])) echo $titular5[0]['id_docente']; ?>">

<input type="hidden" class="requerido2" id="suplente1" name="suplente1" value="<?php echo $suplente1[0]['id_docente']; ?>">
<input type="hidden" class="requerido2" id="suplente2" name="suplente2" value="<?php echo $suplente2[0]['id_docente']; ?>"> 
<?php } ?>
</form>

</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
