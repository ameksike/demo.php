<?php
/**
 * @package    IPC
 * @subpackage php
 * @author     ing. Antonio Membrides Espinosa
 * @date       15/03/2013
 * @version    1.0
 */
//---------------------------------------------------------------------------
	$cfg['shmid']= 0xff5;
	$cfg['mode'] = "c";
	$cfg['perm'] = 0666;
	$cfg['size'] = 5;
	return $cfg;
?>
