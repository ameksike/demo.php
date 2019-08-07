<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WBr es la clase que define un salto de linea en el documento
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WBr extends WNode
	{
		public function __construct($tile="", $src=""){
			parent::__construct("br");
			$this->tags[">"]= "/>";
		}
	}
?>
