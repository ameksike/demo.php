<?php
/**
 * @package     ipc
 * @subpackage  iface
 * @description Implementa un patron de diseño: publicador/subscriptor
 * @author      ing. Antonio Membrides Espinosa
 * @date        07/10/2012
 * @version    
 */
	class Observed
	{
		protected $subscribers;
		public function __construct()
		{
			$this->subscribers = array();
		}
		protected function notify($data)
		{
			foreach($this->subscribers as $i) $i->update($data);
			return $this;
		}
		public function supply($obj, $key=false)
		{
			if(!$key) $this->subscribers[] = $obj;
			else $this->subscribers[$key] = $obj;
			return $this;
		}
		public function remove($key=0)
		{
			unset($this->subscribers[$key]);
			return $this;
		}
	}
