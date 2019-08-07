<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WHead es la clase que define los atributos del titulo para el Head
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	require_once "WTitle.php";
	class WHead extends WNode
	{
		public function __construct($tile=""){
			parent::__construct("head", new WTitle($tile));
		}
	}
?>
