<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WInput es la clase que define un componente input
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WInput extends WNode
	{
		public function __construct($name="submit", $value="submit", $type="submit"){
			parent::__construct("input", $name);
			$this->tags[">"] = "/>";
			$this->value = $value;
			$this->type  = $type;		
		}
	}
?>
