 <?php
 /**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       10/01/2013
 * @version    1.5
 */
//---------------------------------------------------------------------------
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

	$cfg = include "cfg.php";


	include "src/IfaceSHM.php";
	$shm = new IfaceSHM($cfg);

/*
	include "src/IfaceMSG.php";
	$shm = new IfaceMSG($cfg);
*/
	$shm->supply(new Receptor($shm))->listen();
