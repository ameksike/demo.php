<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WDocument es la clase que define los atributos del documento
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WDocument extends WNode
	{
		public function __construct($tile="", $attributes="", $childs=false){
			
			parent::__construct("document", "",array(
				"head"=> new WHead($tile),
				"body"=> new WBody($childs, $attributes)
			));
		}

		public function setTitle($title="")
		{
			$this->items["head"]->items->items = $title;
		}
		
		public function appendChild($el)
		{
			$this->items["body"]->appendChild($el);
		}

		public function __get($key)
		{
			if($key=="head" || $key=="body") 
				return $this->items[$key];
			else if (isset($this->property[$key]))
			    	return $this->property[$key];
		}

		public function getElementAt($key){
			return $this->items["body"]->items[$key];
		}

		public function createElement($tagName="form"){}
		public function getElementById($id){}
		public function getElementsByTagName($tagName){}
	}
?>
