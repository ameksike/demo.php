<?php
	/**
	 * @author		Antonio Membrides Espinosa
	 * @package    	model
	 * @date		21/06/2015
	 * @copyright  	Copyright (c) 2015-2015 XETID
	 * @license    	XETID
	 * @version    	1.0
	 */
	class Model_Automatic extends ZendExt_Model
	{	
		protected $entity;
		public function __construct() {
			parent::__construct();
			$this->entity = str_replace('Model', '', get_class($this));
        }
		public function __call($action, $arguments){
		   if(!method_exists($this, $action) && $this->entity !== ''){
			   return call_user_func_array(array((new $this->entity()), $action), $arguments);
		   }
		}
	}
