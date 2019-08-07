<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WTitle es la clase que define los atributos del titulo para el documento
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WTitle extends WNode
	{
		public function __construct($tile="news"){
			parent::__construct("title", $tile);
		}
	}
?>
