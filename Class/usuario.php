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
				
			$this->setData($results[0]);
			
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


	public function setData($dados){


		$this->setIdUsuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtCadastro(new DateTime($dados['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",array(
			":LOGIN"=>$this->getDeslogin(),
			":SENHA"=>$this->getDessenha()
			));

		if (count($results)>0){
			$this->setData($results[0]);
			echo "TUDI OK";
		} else{
			echo "Algo nao deu Certo <br>";
		}

	}

	public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuario SET deslogin=:login, dessenha=:password WHERE idusuario=:id", array(
			':login'=>$this->getDeslogin(),
			':password'=>$this->getDessenha(),
			':id'=>$this->getIdUsuario()
			));

	}



	public function login($login, $password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE deslogin=:login AND dessenha=:password", array(
			":login" => $login,
			":password"=> $password
			));

		if (isset($results[0])){

			$this->setData($results[0]);

			
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