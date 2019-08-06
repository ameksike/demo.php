<?php
/**
 * @package     ipc
 * @subpackage  iface
 * @description Implementa una interfaz de comunicación entre procesos utilizando la técnica IPC/Shared Memory
 * @author      ing. Antonio Membrides Espinosa
 * @date        07/10/2012
 * @version    
 */
include  dirname(__FILE__)."/Observed.php";
include  dirname(__FILE__)."/IfaceCOM.php";
abstract class IfaceIPC extends Observed implements IfaceCOM
{
	protected $status;
	protected $msg;
	protected $id;
	protected $freq;
	protected $mode;
	protected $perm;
	protected $size;

	public function __construct($config=false)
	{
		parent::__construct();
		$this->resource = false;
		$this->status = 1;
		$this->id = 0xff5; 
		$this->freq = 1;
		$this->msg = "";
		$this->size = 1024;
		$this->mode = "persistent";
		$this->perm = 0666;
		$this->setting($config);
	}

	public function setting($config, $key='id')
	{
		if(is_array($config)) {
			foreach($config as $k=>$i) if (isset($this->{$k})) $this->{$k} = $i;
		}else if ($config && isset($this->{$key})) $this->{$key} = $config;
		return $this;
	}

	public function listen()
	{
		while($this->status){
			$this->update($this->read());
			sleep($this->freq);
		}
	}

	public function stop()
	{
		$this->status = 0;
		return $this;
	}

	public function getInfo(){
		return array(
			'status'=>$this->status,
			'freq'=>$this->freq,
			'mode'=>$this->mode,
			'perm'=>$this->perm
		);
	}
	abstract protected function update($data);
	abstract protected function connect($force=false);
}
