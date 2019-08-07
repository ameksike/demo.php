<?php
/**
 *
 * @package: expire
 * @version: 0.1
 * @description: Expire Manager Library
 * @authors: ing. Antonio Membrides Espinosa
 * @update: 12/03/2013
 * @license: GPL v3
 *
 */
	class ExProd
	{
		private $type;
		private $obs;
		public  $freq;
		public  $pivot;
		public  $local;
		public  $path;
		public static $__this = false;
		public static function this()
		{
			$cfg  = include dirname(__FILE__)."/InProd.php";
			$args = func_get_args();
			$args[2] = isset($args[2]) ? $args[2] : $cfg['type'];
			$args[1] = isset($args[1]) ? $args[1] : $cfg['path'];
			$args[0] = isset($args[0]) ? $args[0] : $cfg['pivot'];
			if(!static::$__this) static::$__this = new self($args[0], $args[1], $args[2]);
			return static::$__this;
		}
		
		private function __construct($pivot=50, $path='prod.log', $type='term')
		{
			$this->local = $this->trace();
			$this->update($pivot, false, $path);
			$this->obs = array();
			$this->type = $type;
			$this->res = 0;
			$this->freq = 0;
		}

		public function run()
		{
			if(file_exists($this->path))
				$this->execute($this->{$this->type}());
			else $this->update();
			return $this;
		}

		public function update($pivot=0, $force=false, $path=0)
		{
			$force = $this->type!='term' ? true : $force;
			$this->path = $path ? $path : $this->path;
			$this->pivot = $pivot ? $pivot : $this->pivot;
			$this->local = $this->log()->local;
			$this->freq = $this->log()->freq + -1;
			$this->makelog($force);
			return $this;
		} 
		public function supply($on, $key='key') 
		{
			if(!$key) $this->obs[]= $on; 
			else $this->obs[$key]= $on; 
			return $this;
		}
		public function remove($key='key') { unset($this->obs[$key]); return $this; }
		private function trace() { return date('Ymd'); }
		private function execute($pivot){  foreach($this->obs as $i) $i->doit($pivot, $this->log()); }
		private function log()
		{
			if(!file_exists($this->path)) return $this;
			return unserialize(file_get_contents($this->path));
		}
		private function makelog($force=false)
		{
			if(!file_exists($this->path) || $force){
				file_put_contents($this->path, serialize($this));
			}
		}
		private function term()
		{
			$x = $this->log();
			$c = $this->trace();
			$l = ($x->pivot>=10000000) ? $x->pivot : $x->local+$x->pivot;
			return $l-$c;
		}
		private function frequency()
		{
			return $this->log()->pivot - $this->log()->freq;
		}
		private function both()
		{
			$t = $this->term();
			$f = $this->frequency();
			if($t>$f) return $f; 
			else return $t;
		}
	}
