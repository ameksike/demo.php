<?php
/**
 * @package     ipc
 * @subpackage  iface
 * @description Implementa una interfaz de comunicación entre procesos utilizando la técnica IPC/Shared Memory
 * @author      ing. Antonio Membrides Espinosa
 * @date        07/10/2012
 * @version    
 */
include_once dirname(__FILE__)."/Observed.php";
class IfaceSHM extends Observed
{
	protected $status;
	protected $msg;
	protected $shm;

	protected $freq;
	protected $shmid; 
	protected $mode;
	protected $modex;
	protected $perm;
	protected $size;

	public function __construct($config=false)
	{
		parent::__construct();
		$this->status = 1;
		$this->freq = 1;
		$this->msg = "";

		$this->shmid = 0xff5; 
		$this->mode = "c";
		$this->modee = "persistent";
		$this->perm = 0666;
		$this->size = 1024;
		$this->setting($config);
	}

	public function setting($config, $key='freq')
	{
		if(is_array($config)) {
			foreach($config as $k=>$i) if (isset($this->{$k})) $this->{$k} = $i;
		}else if ($config && isset($this->{$key})) $this->{$key} = $config;
		return $this;
	}

	public function listen()
	{
		$this->connect();
		while($this->status){
			$out = shmop_read ($this->shm, 0, $this->size);
			if($out != $this->msg){
				$this->msg = $out;
				$this->notify(trim($out));
			}sleep($this->freq);
		}
	}

	public function stop()
	{
		$this->status = 0;
		return $this;
	}

	public function send($data)
	{
		$this->connect();
		shmop_write ($this->shm, str_pad($data, $this->size), 0);
		return $this;
	}

	public function release()
	{
		shmop_delete($this->shm);
		$this->shm = false;
		return $this;
	} 

	public function close()
	{
		shmop_close($this->shm);
		$this->shm = false;
		return $this;
	}
	
	protected function connect($force=false)
	{
		if($this->modex != "persistent" || $force || !$this->shm)
			$this->shm = shmop_open($this->shmid, $this->mode, $this->perm, $this->size);
	}
}
