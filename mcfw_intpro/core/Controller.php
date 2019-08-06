<?php
class Controller
{
	protected $cfg;
	protected $db;
	public function __construct()
	{
		$path = dirname(__FILE__).DIRECTORY_SEPARATOR;
		$this->cfg = include "$path..".DIRECTORY_SEPARATOR."cfg".DIRECTORY_SEPARATOR."config.php";
		$this->db = new MDB4MySQL( 
			$this->cfg["db"]["name"],
			$this->cfg["db"]["user"],
			$this->cfg["db"]["pass"],
			$this->cfg["db"]["server"]
		);
	}
}
