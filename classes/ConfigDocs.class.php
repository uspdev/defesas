<?php

class ConfigDocs {
	private $banco;
	public function __construct(){
		$this->banco = Banco::instanciar();
	}
	public function ver(){
		return $this->banco->listar('configdocs','*',null, 'id_config DESC',1); // Trazer apenas a última inserção
	}
	public function inserir($post){ 
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->inserir('configdocs',$post);
	}
}
