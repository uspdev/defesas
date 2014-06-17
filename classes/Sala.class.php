<?php

class Sala {
	private $banco;
	public function __construct(){
		$this->banco = Banco::instanciar();
	}
	public function cadastrarSala($post){ 
		$post['created_at'] = date('Y-m-d H:i:s');
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->inserir('sala',$post);
	}

	public function listarSalas(){
		return $this->banco->listar('sala');
	}
	public function verSala($code_sala){
		$where = " code_sala = $code_sala";
		return $this->banco->listar('sala','*',$where);
	}
	
	public function alterarSala($post,$code_sala) {
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->alterar('sala',$post,"code_sala = $code_sala");
	}

	public function apagarSala($code_sala){
		$where = "code_sala = $code_sala";
		return $this->banco->apagar('sala',$where);
	} 
}

?>
