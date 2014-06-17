<?php

//banco principal
define('DBHOST','x');
define('DBNAME','x');
define('DBUSER','x');
define('DBSENHA','x');

session_start();

function __autoload($classe) {
	if(file_exists("app/$classe.php") ){
		require_once("app/$classe.php");
	} else {
			require_once("classes/$classe.class.php");
	}
}
