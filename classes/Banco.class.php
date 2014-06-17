<?php 

	class Banco {
	private $db;
	public static $instancia;

	//singleton
	public static function instanciar() {
		//self eh igual ao this, mas como $instacia eh static tem que usar o self
		if(!self::$instancia) {
			self::$instancia = new Banco;
			self::$instancia->conectar(DBHOST,DBNAME,DBUSER,DBSENHA);
		}
		return self::$instancia;
	}	
	public function conectar($host,$banco,$usuario,$senha){
		try {
		$this->db = new PDO("pgsql:host=$host;dbname=$banco",$usuario,$senha); 
		}
		catch (PDOException $erros){
			file_put_contents('/tmp/db_erros.txt',$erros->getMessage(),FILE_APPEND);
		}
	}
	public function inserir($tabela,$dados){
		foreach($dados as $coluna => $valor) {
			$colunas[] = $coluna;
			$valores[] = $valor;
			$subs[] = '?';
		}
			
		$colunas = implode(', ', $colunas);
		$subs = implode(', ', $subs);		
		$query = "INSERT INTO $tabela ($colunas) VALUES ($subs)";
		$this->db->beginTransaction();
		$statement = $this->db->prepare($query);
		$statement->execute($valores);
		$last_id = $this->db->lastInsertId(); 
		$this->db->commit();
		return $last_id;
	
	}
	public function alterar($tabela,$dados,$where=null){
		foreach($dados as $coluna => $valor) {
			$colunas[] = " $coluna = ?";
			$valores[] = $valor;
		}
		$colunas = implode(', ', $colunas);
		$query = "UPDATE $tabela SET $colunas"; 
		if(!empty($where)) $query .= " where $where"; 
		$statement = $this->db->prepare($query);
		$statement->execute($valores);	
	}

	public function listar($tabela,$campos='*',$where=null, $order=null, $limite=null){
		$query = "SELECT $campos FROM $tabela ";
		if(!empty($where)) $query .= " where $where";
		if(!empty($order)) $query .= " order by $order";
		if(!empty($limite)) $query .= " limit $limite"; 
		$statement = $this->db->prepare($query);
		$statement->execute();
		return $statement->fetchAll();
		//$result_select = $this->db->query($query);
		//return $result_select->fetchAll();
	}
	
	public function apagar($tabela,$where){
		$query = "DELETE from $tabela";
		if(!empty($where)) $query .= " where $where";
		$statement = $this->db->prepare($query);
		return $statement->execute();
	}
}


//$obj = new Banco;
//$obj->conectar('localhost','defesas','defesas','defesas123456*');
//$db = Banco::instanciar();

//Criar Usuário
//$obj->inserir('users',array('username'=>'jggkkkfa3','email'=>'3vjergsggyimotgv@gmail.cm','password'=>'123456','created_at'=>'2011-10-01 14:00:14','permission'=>0));

//Alterar usuário
//$obj->alterar('users',array('username'=>'thiago','password'=>'tgads'), ' `id_user` = 2' );

//apagar usuário
//$obj-> apagar('users',' id_user=4');

//listar usuários
//$resultados = $obj->listar('users'); echo "<pre>"; print_r($resultados);

?>
