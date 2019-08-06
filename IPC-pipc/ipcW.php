<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       10/01/2013
 * @version    1.5
 */
//---------------------------------------------------------------------------
	class Reader
	{
		public function __construct($dvr){ $this->dvr = $dvr; }
		public function update($data)
		{
			if($data!='show') $this->dvr->stop();
			echo "$data \n";
		}
	}

	$cfg = include "cfg.php";
	$dta = isset($argv[1]) ? $argv[1] : $_REQUEST['dta']; 

/**/
	include "src/IfaceSHM.php";
	$shm = new IfaceSHM($cfg);

/*
	include "src/IfaceMSG.php";
	$shm = new IfaceMSG($cfg);
*/
	$shm->send($dta)
	->setting(1, 'freq')
        ->supply(new Reader($shm))
	->listen();

