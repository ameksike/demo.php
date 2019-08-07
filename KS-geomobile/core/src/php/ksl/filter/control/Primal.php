<?php
/**
 *
 * @framework: Ksike
 * @package: filter
 * @subpackage: control
 * @version: 0.1

 * @description: Primal es una libreria para el trabajo con ...
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 01/06/2010
 * @update-Date: 01/06/2010 
 * @license: GPL v3
 *
 */
namespace Ksike\ksl\filter\control;
use Ksike\ksl\base\helpers\Assist as Assist;
class Primal 
{
	protected $_mate;
	protected $session;
	public function __construct($_mate=false){
		$this->session = Assist::package("session");
		$this->_mate = $_mate;
	}

	public function get($key)
	{
		return Assist::package("session")->get($key, $this);
	}

	public function save($key, $value)
	{
		Assist::package("session")->save($key, $value);
	}

	public function preAction($params, $action) {}
	public function posAction($params, $action) {}
	public function load($key) {
		$tmp = Assist::driver('WDOM');
		unset($tmp);
	}
	public function __destruct(){}

	public function __call($action, $params)
	{
		if(!method_exists($this, $action) ) {
			if($this->_mate) return call_user_func_array(array($this->_mate, $action), $params);	
			else return "_lost_";
		}
	}

	public function __get($key)
	{
		if(!property_exists($this, $key)){
			if(!$this->_mate) return false;
			else return $this->_mate->$key;
		}
	}

	public function __set($key, $value)
	{
		if(!property_exists($this, $key) && $this->_mate){
			$this->_mate->$key = $value;
		}
	}

	public function __isset($key)
	{
		if(!property_exists($this, $key) && $this->_mate){
			return isset($this->_mate->$key);
		}
	}

	public function __unset($key)
	{
		if(!property_exists($this, $key) && $this->_mate){
			unset($this->_mate->$key);
		}
	}
}
