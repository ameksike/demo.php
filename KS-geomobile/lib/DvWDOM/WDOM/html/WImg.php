<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WImg es la clase que define un componente img
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WImg extends WNode
	{
		public function __construct($src="", $name="img"){
			parent::__construct("img", $name);
			$this->tags[">"] = "/>";
			$this->src = $src;
		}
	}
?>
