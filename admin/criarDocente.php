<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$docente = new Docente;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 1) 	die('Você não possui acesso a esta área');

if(!empty($_POST)){ 
	if(isset($_SESSION['codpes'])) $_POST['last_user'] = $_SESSION['codpes']; 
	$docente->cadastrarDocente($_POST);
	header('location:verDocentes.php');
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
<form action="criarDocente.php" method="POST">

<label>Nome Completo </label> 
<input type="text"  class="requerido" name="nome" /> 

<label>Número USP </label> 
<input class="campomenor"  class="requerido" type="text" name="n_usp" />  

<label> CPF </label> 
<input class="cpf"  class="requerido" type="text" name="cpf" />  

<label>Tipo de Documento</label> 
<select name="tipo"> 
	<option value="RG" selected="selected"> RG </option>
	<option value="PASSAPORTE"> Passaporte </option>
	<option value="RNE"> Registro Nacional de Estrangeiros </option>
</select>  

<label> Documento </label>  
<input type="text" name="documento" style="width:200px"  />   

<label> Endereço </label> 
<input type="text"  class="requerido" name="endereco" />  

<label> Bairro</label> 
<input type="text"  name="bairro" />  

<label>CEP </label> 
<input type="text"  name="cep" style="width:100px"/>  

<label>Cidade </label>  
<input type="text"   name="cidade" style="width:200px"  />  

<label>Estado</label> 
<input type="text"   name="estado" style="width:150px"/>  

<label>Pais</label>
<input type="text" name="pais" value="Brasil" style="width:200px"  />  

<label>PIS PASEP</label> 
<input type="text" name="pis_pasep" style="width:200px" />  

<label>Banco</label> 
<input type="text" name="banco" style="width:200px"  /> 

<label>Agência</label> 
<input type="text" name="agencia" style="width:200px"  />  

<label>Conta Corrente</label> 
<input type="text" name="c_corrente" style="width:200px"  /> 

<label>Telefones </label> 
<input type="text"  name="telefone"   />  

<label> Nome e sigla da Universidade na qual tem vínculo profissional </label> 
<input type="text"  class="requerido" name="lotado" />  

<label>E-mail </label> 
<input type="text"   name="email" />  

<label>Status</label> 
<select name="status"> 
	<option value="B" selected="selected"> Brasileiro </option>
	<option value="E"> Estrangeiro </option>
</select> 

<label>Docente USP?</label> 
<select name="docente_usp"> 
	<option value="sim" selected="selected"> Sim </option>
	<option value="nao"> Não </option>
</select>   

 
<br />
<input type="submit" value="Cadastar Docente" >
</form>
</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

</body>
</html>
