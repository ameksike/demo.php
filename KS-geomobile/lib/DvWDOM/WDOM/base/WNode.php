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
	require_once "WObject.php";
	class WNode extends WObject
	{
		public function appendChild($el){
			$this->add($el);
		}
		public function add($el, $key=false){
			if(!is_array($this->items))
				$this->items = array($this->items);
			if($key) $this->items[$key] = $el;
			else $this->items[] = $el;
		}
		public function hasAttributes(){
			if(count($this->property)>0) return true;
			return false;
		}
		public function removeChild($oldChild){}
		public function replaceChild($newChild, $oldChild){}
		public function insertBefore($newChild, $refChild){}
	}
?>
