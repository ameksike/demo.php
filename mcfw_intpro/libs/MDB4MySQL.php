<?php
class MDB4MySQL
{

	//.......................... Declaracion de Variables .......
	public $user;                  // user para conectarme al servidor;
	public $pass;                  // contraseña para conectarme al servidor
	public $server;                // direcion IP del servidor en ocaciones puede ser : "localhost"
	public $dbname;                // nombre de la base de datos deseada
	protected $driver;             // Contiene un objeto de tipo mysql_connect para saber si tubo exito o no la conexion
	//.......................... Declaracion de Metodos .......
	public function __construct($dbname="default", $user="root", $pass="root", $server="localhost")
	{
		$this->user   = $user;
		$this->pass   = $pass;
		$this->server = $server;
		$this->dbname = $dbname;	
	}

	public function exec($sql, $SELECT=1)
	{
		$this->conect();
		$cantidad = mysql_query($sql);
		if($SELECT)
		{
			while( $res = mysql_fetch_assoc($cantidad) )
			$out[] = $res;
			$this->disconect();
			return $out;
		}$this->disconect();
	}

	protected function conect()
	{
		$this->driver = mysql_connect($this->server, $this->user, $this->pass)
		or  die("ERROR: No se pudo establecer la coneccion con el servidor");
		mysql_select_db($this->dbname, $this->driver)
		or die ("ERROR: No se pudo establecer la coneccion con la BD");
	}

	protected function disconect()
	{
		mysql_close($this->driver)
		or die ("ERROR: No se pudo cerrar la coneccion");
	}

	public function getDriver()
	{
		return  $this->driver;
	}
}
