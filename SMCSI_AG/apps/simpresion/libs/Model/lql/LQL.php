<?php
/**
 * @description LQL it's alternative Light Query Language suport for PHP library
 * @author		Antonio Membrides Espinosa
 * @package    	model
 * @date		15/05/2013
 * @license    	GPL
 * @version    	1.0
 * @require		SQLDriver
 */
class LQL 
{
	protected $commands;
	protected $executor;
	protected $processor;
	protected static $obj = false;

	public function __construct(LQLExecutor $executor=null, LQLProcessor $processor=null){
		$this->commands = array();
		$this->executor = $executor ? $executor : new LQLExecutor();
		$this->processor = $processor ? $processor : new LQLProcessor();
		$this->executor->clear();
		$this->processor->clear();
	}
	public function __call($action, $arguments){
	   if(!method_exists($this, $action)){
		  $this->commands[$action][] = $arguments;
		  return $this;
	   }
	}
	
	public function setting(LQLExecutor $executor=null, LQLProcessor $processor=null){
		$this->executor = $executor ? $executor : $this->executor;
		$this->processor = $processor ? $processor : $this->processor;
		return $this;
	}
	public function clear(){
		unset($this->commands);
		$this->commands = array();
		return $this;
	}
	
	public function compile($force=false){
		return $this->processor->compile($this->commands, $force);
	}
	public function query($data=false, $force=false){
		return $this->execute($data, $force);
	}
	public function execute($data=false, $force=false){
		return $this->executor->execute(
			$this->processor
				 ->setting($data)
				 ->compile($this->commands, $force)
		);
	}
	public function fetchAll($sql=false){
		return $this->execute();
	}
	public function fetchArray($sql=false){
		return $this->execute();
	}

	public static function create(LQLExecutor $executor=null, LQLProcessor $processor=null){
		$executor = $executor ? $executor : self::$obj ? self::$obj->executor : $executor;
		$processor = $processor ? $processor : self::$obj ? self::$obj->processor : $processor;
		return new static($executor, $processor);
	}
	public static function this(LQLExecutor $executor=null, LQLProcessor $processor=null){
		parent::$obj = self::$obj ? self::$obj : self::create($executor, $processor);
		return self::$obj;
	}
}
/**
 * @description LQL Executor Iface
 * @author		Antonio Membrides Espinosa
 * @package    	model
 * @date		15/05/2013
 * @license    	GPL
 * @version    	1.0
 * @require		SQLDriver
 */
class LQLExecutor
{
	protected $cache;
	public 		function clear(){
		$this->cache = '';
	}
	public function execute($data){
		return $data;
	}
}
/**
 * @description LQL Processor Iface
 * @author		Antonio Membrides Espinosa
 * @package    	model
 * @date		15/05/2013
 * @license    	GPL
 * @version    	1.0
 * @require		SQLDriver
 */
class LQLProcessor
{
	protected 	$cache;
	protected 	$jobs;
	public 		function clear(){}
	public 		function setting($cache=false){}
	public 		function compile($struct, $force=false){
			return $struct;
	}
	protected 	function evaluate($value, $quote=false){}
	protected 	function generate(&$tmp=false, $jobs=false){}
	protected 	function format($key, $value){}
}
