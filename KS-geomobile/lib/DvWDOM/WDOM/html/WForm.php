<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WNode es la clase que define las funciones compatibles con DOM para cada nodo
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WForm extends WNode
	{
		public function __construct($name="form", $items=array()){
			parent::__construct("form", $name, $items);
			if(!$this->method) $this->method = "post";
			if(!$this->action) $this->action = "";
			if(!$this->enable_wml) $this->enable_wml= "true";
		}
	}
?>
