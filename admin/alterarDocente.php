<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$usuarios = new Users;
$obj_docente = new Docente;
$status = $usuarios->verificarStatus();
$configdocs = new ConfigDocs;
$info = $configdocs->ver();
if($status != 1) 	die('Você não possui acesso a esta area');

if(!empty($_GET['id_docente'])) {
	$docente = $obj_docente->verDocente($_GET['id_docente']);
	if(!$docente) die("Docente não cadastrado");
  else foreach($docente[0] as $key => $value) $docente[0][$key] = $value;
}

if(!empty($_POST)){ 
	if(isset($_SESSION['codpes'])) $_POST['last_user'] = $_SESSION['codpes']; 
	$obj_docente->alterarDocente($_POST,$_GET['id_docente']); 
	header('location:buscarDocente.php?alterado=sim');
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

<?php if(isset($docente[0]['last_user'])) $ultimo = $usuarios->verUsuario($docente[0]['last_user']);
			else $ultimo = $usuarios->verUsuario(5385361); 
			if(isset($docente[0]['updated_at'])) {
				$modificado = explode(' ',$docente[0]['updated_at']);
				$modificado = implode('/',array_reverse(explode('-',$modificado[0]))); 
			}  
 ?>

Últimas alterações: <br> 
<i> Por <?php echo $ultimo[0]['nome']; ?> </i> 
<i>, em <?php echo $modificado; ?> </i> <br><br>


<form action="alterarDocente.php?id_docente=<?php echo $_GET['id_docente'] ?>" method="POST">
<?php foreach ($docente as $dados) { ?>

<label>Nome Completo </label> 
<input type="text" class="requerido" name="nome" value="<?php echo $dados['nome']; ?>" />  

<label>Número USP </label> 
<input type="text" name="n_usp" value="<?php echo $dados['n_usp']; ?>" />  

<label> CPF </label>
<input type="text" class="cpf" name="cpf" value="<?php echo $dados['cpf']; ?>" />  

<label> Tipo de Documento </label> 
<select name="tipo"> 
  <option value="RG" <?php if($dados['tipo']=='RG') echo 'selected="selected"'; ?> >RG</option>
  <option value="PASSAPORTE" <?php if($dados['tipo']=='PASSAPORTE') echo 'selected="selected"'; ?> >Passaporte</option>
  <option value="RNE" <?php if($dados['tipo']=='RNE') echo 'selected="selected"'; ?> >Registro Nacional de Estrangeiros</option>
</select> 

<label> Documento </label> 
<input style="width:200px"  type="text" name="documento" value="<?php echo $dados['documento']; ?>" />  

<label> Endereço </label>  
<input type="text" name="endereco" class="requerido" value="<?php echo $dados['endereco']; ?>" />  

<label>Bairro </label>  
<input type="text" name="bairro"  value="<?php echo $dados['bairro']; ?>" />  

<label>CEP </label> 
<input style="width:200px"  type="text" name="cep"  value="<?php echo $dados['cep']; ?>" />  

<label>Cidade </label> 
<input style="width:200px"  type="text" name="cidade"  value="<?php echo $dados['cidade']; ?>" />  

<label>Estado</label> 
<input style="width:200px"  type="text" name="estado"  value="<?php echo $dados['estado']; ?>" />  

<label>Pais</label> 
<input style="width:200px"  type="text" name="pais"  value="<?php echo $dados['pais']; ?>"  />  

<label>PIS PASEP</label> 
<input style="width:200px"  type="text" name="pis_pasep" value="<?php echo $dados['pis_pasep']; ?>" />  


<label>Banco</label> 
<input style="width:200px"  type="text" name="banco" value="<?php echo $dados['banco']; ?>" />  

<label>Agência</label> 
<input style="width:200px"  type="text" name="agencia" value="<?php echo $dados['agencia']; ?>" />  

<label>Conta Corrente</label> 
<input style="width:200px"  type="text" name="c_corrente" value="<?php echo $dados['c_corrente']; ?>" /> 

<label>Telefones </label> 
<input type="text" name="telefone" value="<?php echo $dados['telefone']; ?>" />  

<label>Nome e sigla da Universidade na qual tem vínculo profissional</label>
<input type="text" name="lotado" class="requerido" value="<?php echo $dados['lotado']; ?>" />  

<label>E-mail</label>
<input type="text" name="email" value="<?php echo $dados['email']; ?>" />  

<label>Status</label>
<select name="status"> 
  <option value="B" <?php if($dados['status']=='B') echo 'selected="selected"'; ?> >Brasileiro</option>
  <option value="E" <?php if($dados['status']=='E') echo 'selected="selected"'; ?> >Estrangeiro</option>
</select>  

<label> Docente USP? </label> 
<select name="docente_usp"> 
  <option value="sim" <?php if($dados['docente_usp']=='sim') echo 'selected="selected"'; ?> >Sim</option>
  <option value="nao" <?php if($dados['docente_usp']=='nao' || !isset($dados['docente_usp']) ) echo 'selected="selected"'; ?> >Não</option>
</select> 

 
<?php } ?>
<br />
<input type="submit" value="Aplicar Alterações" >
<form>
</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>
</body>
</html>
