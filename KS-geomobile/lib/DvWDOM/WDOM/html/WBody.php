<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WBody es la clase que define los atributos del cuerpo para el documento
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WBody extends WNode
	{
		public function __construct($items=false, $attribute=""){
			parent::__construct("body", $attribute, $items);
		}
	}
?>
