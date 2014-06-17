<?php
header("Content-type: text/html;charset=utf-8");
require('../config.php');

$configdocs = new ConfigDocs;
$info = $configdocs->ver();

//$user = new Users;
////$status = $user->verificarStatus();
//if($status != 1) 	die('Você não possui acesso a esta área');

$docente = new Docente;
$todos = $docente->listarDocentesGeral('nome,n_usp,lotado'," docente_usp='nao' ");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	
	<title></title>
</head>

<body>
    <table border="1">         
    <tr>
        <td> <b> Nome</b> </td> 
        <td> <b>N. USP</b></td>
        <td> <b>Sigla da Universidade</b> </td>                    
    </tr> 
    <?php 
    foreach($todos as $professor_utf8) 
    {
        echo "<tr>
                <td> $professor_utf8[0] </td> 
                <td> $professor_utf8[1] </td>
                <td> $professor_utf8[2] </td>                    
             </tr> ";

    }
    ?>
    </table>


</body>
</html>