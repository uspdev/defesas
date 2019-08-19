<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');
$user = new Users;
$docente = new Docente;
$candidato =  new Candidato;
$area_obj =  new Area;
$status = $user->verificarStatus();
$hoje = date('Y-m-d H:i:s');
$where = "data_horario >= '$hoje'";
$todos = $candidato->listarCandidatos('candidato',$where);
$configdocs = new ConfigDocs;
$info = $configdocs->ver();

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" href="../defesas.css" type="text/css" media="all" />
	<title> </title>
<style type="text/css">
</style>


</head>

<body>

<div id="wrapper">
	<div id="header">
	<?php echo $info[0]['sitename'] . " agendadas FFLCH USP"; ?>
	</div>


<div>

<table class="table" cellspacing='0'>
<tr>
<th>Data defesa</th>
<th>Horário</th>
<th>Programa/Área</th>
<th>Nome</th>
<th>Nível</th>
<th>Título</th>
<th>Orientador(a)</th>
</tr>

<?php
//echo "<pre>";
//var_dump($todos); die();
?>
<?php foreach ($todos as $value) { ?>
<tr> 
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
  <?php 
    $area = $area_obj->verArea($value['area']);
    //echo "<pre>"; var_dump($orientador);die();
    echo $area[0]['nome_area'];
   ?>
 </td>

 <td>
  <?php echo $value['nome']; ?>
 </td>
  <td> <?php echo $value['nivel']; ?> </td>
  <td> <?php echo $value['titulo']; ?> </td>


 <td>
  <?php 
    $orientador = $docente->verDocente($value['orientador']);
    //echo "<pre>"; var_dump($orientador);die();
    echo $orientador[0]['nome'];
   ?>
 </td>

</tr>

<?php } ?>
</table>

</div>
	<div id="footer" class="clear">
	<?php print $info[0]['rodape_site']; ?>
	</div>
</div>

	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript" src="../js/defesas.js"></script>
<script type="text/javascript" src="../js/ui.datepicker-pt-BR.js"></script>

</body>
</html>
