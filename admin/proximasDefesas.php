<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$docente = new Docente;
$candidato =  new Candidato;
$status = $user->verificarStatus();
$hoje = date('Y-m-d H:i:s');
$where = "data_horario >= '$hoje'";
$todos = $candidato->listarCandidatos('candidato',$where);
$configdocs = new ConfigDocs;
$info = $configdocs->ver();

if($status != 2 && $status != 1) 	die('Você não possui acesso a esta área');
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
<h1>Candidatos</h1>
<h4>Defesas Marcadas com data a partir de hoje</h4>

<table class="table" cellspacing='0'>
<tr>
<th>N. USP</th>
<th>Nome</th>
<th>Data defesa</th>
<th> Horário </th>
<th colspan="3"><center>Operações</center> </th>
</tr>

<?php foreach ($todos as $value) { ?>
<tr> 
 <td>
  <?php echo $value['codpes']; ?>
 </td>
 <td>
  <?php echo $value['nome']; ?>
 </td>
 <td>
  <?php $data = explode(' ',$value['data_horario']);
								$horario = explode(':',$data[1]);
        $horario = $horario[0] . ':' . $horario[1]; 
        $data = array_reverse(explode('-',$data[0]));
        echo implode('/',$data);  
  ?>
 </td>
 <td>
  <?php echo $horario; ?>
 </td>
 <td>
  <a href="./geraPDFs.php?id_candidato=<?php echo $value['id_candidato'] ?>"><img src="../images/pdf.png"></a>
 </td>
 <td>
  <a href="./alterarCandidato.php?id_candidato=<?php echo $value['id_candidato'] ?>"> <img src="../images/editar.png"> </a>
 </td>
 <td>
  <a href="./apagarCandidato.php?id_candidato=<?php echo $value['id_candidato'] ?>"> <img src="../images/excluir.png"></a>
 </td>
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
