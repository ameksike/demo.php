<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       15/03/2013
 * @version    1.0
 */
	class Reader
	{
		public function __construct($dvr){ $this->dvr = $dvr; }
		public function update($data)
		{
			if($data!='show') $this->dvr->stop();
			echo "$data \n";
		}
	}

	include "src/IfaceSHM.php";
	$cfg = include "cfg.php";
	$dta = isset($argv[1]) ? $argv[1] : $_REQUEST['dta']; 

	$shm = new IfaceSHM($cfg);
	$shm->send($dta)
	->setting(5)
        ->supply(new Reader($shm))
	->listen();
?>
