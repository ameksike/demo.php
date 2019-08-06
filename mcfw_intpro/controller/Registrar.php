<?php
class Registrar extends Controller
{	
	public function save($usuario, $nombre, $password, $email){
		$dbname = $this->cfg["db"]["name"];

		$query  = "INSERT INTO `$dbname`.`usuario` (
			usuario,
			nombre,
			1apellido,
			2apellido,
			password,
			correo,
			tipo
		) VALUES (
			'$usuario',
			'$nombre',
			'1apellido',
			'2apellido',
			'".md5($password)."',
			'$email',
			'user'
		)";

		$data = $this->db->exec($query);
	}
}
