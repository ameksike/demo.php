<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       10/01/2013
 * @version    1.5
 */
//---------------------------------------------------------------------------
	interface IfaceCOM
	{
		public function send($data);
		public function read();
		public function listen();
		public function release();
		public function stop();
		public function close();
	}
