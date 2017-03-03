<?php

//banco principal
define('DBHOST','localhost');
define('DBNAME','defesas');
define('DBUSER','defesas');
define('DBSENHA','defesas');

session_start();

function __autoload($classe) {
	if(file_exists("app/$classe.php") ){
		require_once("app/$classe.php");
	} else {
			require_once("classes/$classe.class.php");
	}
}
