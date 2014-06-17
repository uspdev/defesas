<?php

class Docente {
	private $banco;
	public function __construct(){
		$this->banco = Banco::instanciar();
	}
	public function cadastrarDocente($post){
		$post['created_at'] = date('Y-m-d H:i:s');
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->inserir('docente',$post);
	}

	public function listarDocentes(){
		return $this->banco->listar('docente','*',null,'nome');
	}
	public function listarDocentesGeral($campos,$where){
		return $this->banco->listar('docente',$campos,$where,'nome');
	}
	public function BuscaDocenteNome($nome){
		$where = "upper(nome) like '%$nome%'";
		return $this->banco->listar('docente','id_docente,nome',$where);
	}
	public function verDocente($id_docente){
		$where = " id_docente = '$id_docente'";
		return $this->banco->listar('docente','*',$where);
	}
	
	public function alterarDocente($post,$id_docente) {
		$post['updated_at'] = date('Y-m-d H:i:s');
		$this->banco->alterar('docente',$post,"id_docente = $id_docente");
	}

	public function apagarDocente($id_docente){
		$where = "id_docente = $id_docente";
		return $this->banco->apagar('docente',$where);
	} 
}


?>
