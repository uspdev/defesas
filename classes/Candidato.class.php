<?php

class Candidato {
	private $banco;
	public function __construct(){
		$this->banco = Banco::instanciar();
	}
	public function cadastrarCandidato($post){
		if(isset($post['data']) && isset($post['horario'])) {
			$post['data_horario'] = implode('-',array_reverse(explode('/',trim($post['data'])))) . " " . trim($post['horario']) . ":00"; 
			unset($post['data']);
			unset($post['horario']);
		}
		$post['created_at'] = date('Y-m-d H:i:s');
		$post['updated_at'] = date('Y-m-d H:i:s'); 
		$this->banco->inserir('candidato',$post); 
	}

	public function listarCandidato(){
		return $this->banco->listar('candidato','*',NULL, 'nome ASC');
	}
	public function listarCandidatos($table,$where){
		return $this->banco->listar($table,'*',$where,' data_horario ASC');
	}
	public function BuscaCandidatoNome($nome){
		$where = " nome like '%$nome%'";
		return $this->banco->listar('candidato','id_candidato,nome',$where);
	}
	public function verCandidato($id_candidato){
		$where = " id_candidato = '$id_candidato'";
		return $this->banco->listar('candidato','*',$where);
	}
	
	public function alterarCandidato($post,$id_candidato) {
		if(isset($post['data']) && isset($post['horario'])) {
			$post['data_horario'] = implode('-',array_reverse(explode('/',trim($post['data'])))) . " " . trim($post['horario']) . ":00";
			unset($post['data']);
			unset($post['horario']);
		}
		$post['updated_at'] = date('Y-m-d H:i:s'); 
		$this->banco->alterar('candidato',$post,"id_candidato = $id_candidato"); 
	}

	public function apagarCandidato($id_candidato){
		$where = "id_candidato = $id_candidato";
		$this->banco->apagar('candidato',$where);
	} 
}

?>
