<?php

class Area {
	private $banco;
	public function __construct(){
		$this->banco = Banco::instanciar();
	}
	public function cadastrarArea($post){ 
		$post['created_at'] = date('Y-m-d H:i:s');
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->inserir('area',$post);
	}

	public function listarAreas(){
		return $this->banco->listar('area');
	}
	public function verArea($code_area){
		$where = " code_area = $code_area";
		return $this->banco->listar('area','*',$where);
	}
	
	public function alterarArea($post,$code_area) {
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->alterar('area',$post,"code_area = $code_area");
	}

	public function apagarArea($code_area){
		$where = "code_area = $code_area";
		return $this->banco->apagar('area',$where);
	} 
}

//include('../config.php');
//$obj = new Users;

//criar usuário
//$post = array('username'=>'thiago', 'email'=>'baby@htmail.com', 'id_user'=>'1');
//$obj->cadastrarUsuario($post);

//apagar usuário
//$obj->apagarUsuario(14);

//logar usuário
//$post = array('username'=>'thiago','password'=>'123456');
//$teste=$obj->logar($post);
//$teste ? $a="verdadeiro" : $a="falso"; echo "$a <br>";
//print_r($_SESSION);

//deslogar
//$post = array('username'=>'baby','password'=>'123456');
//$teste=$obj->logar($post);
//echo "antes: <br>";
//print_r($_SESSION);
//$obj->deslogar();
//echo "depois <br>";
//print_r($_SESSION);

//verificar status
//echo"<br />" . ($obj->verificarStatus());

//listar Usuários
//echo "<pre>";
//print_r($obj->listarUsuarios());

//alterar Usuario
//$post = array('username'=>'bruno','password'=>'123456');
//$obj-> alterarUsuario($post,21);
?>
