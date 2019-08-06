<?php
/**
 * @package     ipc
 * @subpackage  iface
 * @description Implementa una interfaz de comunicación entre procesos utilizando la técnica IPC/Shared Memory
 * @author      ing. Antonio Membrides Espinosa
 * @date        07/10/2012
 * @version    
 */
include_once dirname(__FILE__)."/IfaceIPC.php";
class IfaceSHM extends IfaceIPC
{
	protected $modex;

	public function __construct($config=false)
	{
		$this->modex = "c";
		parent::__construct($config);
	}

	public function read()
	{
		$this->connect();
		return shmop_read ($this->resource, 0, $this->size);
	}

	public function send($data)
	{
		$this->connect();
		shmop_write ($this->resource, str_pad($data, $this->size), 0);
		return $this;
	}

	public function release()
	{
		shmop_delete($this->resource);
		$this->resource = false;
		return $this;
	}

	public function close()
	{
		shmop_close($this->resource);
		$this->resource = false;
		return $this;
	}
	
	protected function connect($force=false)
	{
		if($this->mode != "persistent" || $force || !$this->resource)
			$this->resource = shmop_open($this->id, $this->modex, $this->perm, $this->size);
	}

	protected function update($data)
	{
		if($data != $this->msg){
			$this->msg = $data;
			$this->notify(trim($data));
		}	
	}
}
