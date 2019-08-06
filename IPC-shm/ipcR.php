<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       15/03/2013
 * @version    1.0
 */
	class Receptor 
	{
		public function __construct($dvr) { $this->dvr = $dvr; }
		public function update($data)
		{
			switch($data){
				case "show" : $this->dvr->send('hola'); break;
				case "exit" : $this->dvr->stop(); break;
				case "kill" : $this->dvr->release(); break;
				default: echo $data."|"; break;
			}
		}
	}

	include "src/IfaceSHM.php";
	$cfg = include "cfg.php";
	
	$shm = new IfaceSHM($cfg);
	$shm->supply(new Receptor($shm))->listen();
?>
