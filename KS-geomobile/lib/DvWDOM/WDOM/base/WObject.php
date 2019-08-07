<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1

 * @description: WObject es la clase que define el comportamiento de un nodo
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/07/2011
 * @update-Date: 07/07/2011
 * @license: GPL v3
 *
 */
	class WObject
	{
		public    $items;
		protected $tag;
		protected $tags;
		protected $property;

		public function __construct($tag="", $name="", $items=false){
			$this->items = $items;
			$this->tag = $tag;
			$this->tags = array("<"=> "<", ">"=> ">", "/"=> "/", "#"=> "wall:");
			if(is_array($name)) $this->property = $name;
			else if($name!="") {
				$this->name = $name;
				$this->id = $name;
			}
		}

		public function __get($key)
		{
			if (isset($this->property[$key]))
			    return $this->property[$key];
		}

		public function __set($key, $value)
		{
			if(!is_array($this->property)) $this->property = array();
			$this->property[$key] = $value;
		}

		public function __isset($key)
		{
			return isset($this->property[$key]);
		}

		public function __unset($key)
		{
			unset($this->property[$key]);
		}

		public function render(){
			$str = $this->asStr();
			print($str);
		}

		public function asStr(){
			$str  = $this->getTagIn();
			if($this->tags[">"] != "/>"){
				$str .= $this->getIt($this->items);
				$str .= $this->getTagOut();
			}
			return $str;
		}

		protected function getIt($el){
			switch( gettype($el) )
			{
				case "array":
					$out = "";
					foreach($el as $i)
						$out .= $this->getIt($i);
					return $out;
				break;
				case "object":
					return $el->asStr();
				break;
				case "string": return $el; break;
				default: return ""; break;
			}		
		}

		protected function getTagIn(){
			return $this->tags["<"].$this->tags["#"].$this->tag.$this->implode().$this->tags[">"];
		}

		protected function getTagOut(){
			return $this->tags["<"].$this->tags["/"].$this->tags["#"].$this->tag.$this->tags[">"];
		}
			
		protected function implode(){
			$str = " ";
			if($this->property) foreach($this->property as $k=>$i)
				if(is_string($i)) $str .= "$k='$i' ";
			return $str;
		}

		public function __toString(){
			return $this->asStr();
		}
	}
?>
