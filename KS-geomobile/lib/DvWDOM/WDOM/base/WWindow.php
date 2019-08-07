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
	
	if(!defined('WALL')) define('WALL', 'Wall4PHP-1.1');
	if(!defined('WPATH')) define("WPATH", dirname(__FILE__)."/../../".WALL);
	class WWindow
	{
		protected $wurfl;
 		protected $document;
 		protected $userAgent;

		public function __construct($tile="New Wall App", $wurfl=false, $body=false){
			require_once(WPATH.'/wall_prepend.php');
			require_once(WURFL_CLASS_FILE);
			$this->loadBase();
			$this->document = new WDocument($tile, $body);
			$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
			if($wurfl) $this->loadWurfl();

		}

		public function __get($key)
		{
			if($key == "wurfl" && !isset($this->{$key})) $this->loadWurfl();
			return $this->{$key};
		}

		protected function loadWurfl(){
			require_once (WPATH.'/wurfl/wurfl_config.php');
			$this->wurfl = new wurfl_class();
			$this->wurfl->GetDeviceCapabilitiesFromAgent($this->userAgent);
			$this->document->width  = $this->wurfl->getDeviceCapability('resolution_width');
			$this->document->height = $this->wurfl->getDeviceCapability('resolution_height');
		}

		public function render(){
			$this->document->render();
		}

		public function asStr(){
			$this->document->asStr();
		}

		public function __toString(){
			return $this->document->asStr();
		}

		protected function loadBase(){
			require_once "WNode.php";
			require_once "WDocument.php";
			require_once dirname(__FILE__)."/../html/WHead.php";
			require_once dirname(__FILE__)."/../html/WBody.php";
		}

		public function loadHtml($lst=false, $path="../html/"){
			foreach($lst as $i) require_once $path.$i;
		}
	}
?>
