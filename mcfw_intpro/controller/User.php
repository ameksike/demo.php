<?php
class User extends Controller
{	
	public function __construct(){
		parent::__construct();
	}
	public function isLogin(){
		if(isset($_SESSION['usuario'])) return true; 
		else return false;	
	}

	public function isValid($user, $pass ){
		// verifica que esten los dos campos completos.
		$dbname = $this->cfg["db"]["name"];
		if ($user=='' || $pass=='') return false;
		$query = "SELECT idUsuario, usuario, password, tipo
			 FROM `$dbname`.`usuario` WHERE usuario = '$user'";
		$data = $this->db->exec($query); 
		if(!empty( $data )){
			if($data[0]["password"]==md5($pass)) return true;
			else return false;
		}else return false;
	}

	public function login($user, $pass){
		if($this->isValid($user, $pass )){
			$_SESSION['usuario'] = $user;
			return true;
		}else return false;		
	}

	public function logout(){
		if(isset($_SESSION['usuario'])) unset ($_SESSION['usuario']);
	}


	public function getDatosById($id, $key=false){
		$dbname = $this->cfg["db"]["name"];
		$query = "SELECT * FROM `$dbname`.`usuario` WHERE idUsuario = '$id'";
		$data = $this->db->exec($query);
		$data = $data[0];
		if($key && isset($data[$key])) return $data[$key];
		else return $data;
	}

	public function getDatosByUser($id, $key=false){
		$dbname = $this->cfg["db"]["name"];
		$query = "SELECT * FROM `$dbname`.`usuario` WHERE usuario = '$id'";
		$data = $this->db->exec($query);
		$data = $data[0];
		if($key && isset($data[$key])) return $data[$key];
		else return $data;
	}

	public function getFullName($id){
		$username = $this->getDatosById($id);
		return $username["nombre"]." ".$username["1apellido"]." ".$username["2apellido"];
	}	

	public function getId(){
		if(isset($_SESSION['usuario'])){
			$user = $_SESSION['usuario'];
			$dbname = $this->cfg["db"]["name"];
			$query = "SELECT * FROM `$dbname`.`usuario` WHERE usuario = '$user'";
			$data = $this->db->exec($query);
			$data = $data[0]["idUsuario"];
		}else   $data = false;
		return $data;
	}
}
