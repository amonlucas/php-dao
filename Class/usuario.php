<?php 

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		$this->dtcadastro = $value;
	}


	public function loadByID($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE idusuario=:ID", array(
			":ID" => $id
			));

		if (isset($results[0])){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));

			
		}
	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin;");
	}

	public static function search ($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuario where deslogin LIKE :search ORDER BY deslogin",array(
			':search'=>"%".$login."%"
			));
	}

	public function login($login, $password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE deslogin=:login AND dessenha=:password", array(
			":login" => $login,
			":password"=> $password
			));

		if (isset($results[0])){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));

			
		} else{
			throw new Exception("Acesso Invalido");
			
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"dessenha"=>$this->getDessenha(),
			"deslogin"=>$this->getDeslogin(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y")
			));
	}



}


?>