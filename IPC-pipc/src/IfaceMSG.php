<?php
/**
 * @package     ipc
 * @subpackage  iface
 * @description Implementa una interfaz de comunicación entre procesos utilizando la técnica  basada en colas de mensajes
 * @author      ing. Antonio Membrides Espinosa
 * @date        07/10/2012
 * @version    
 */
include_once dirname(__FILE__)."/IfaceIPC.php";
class IfaceMSG extends IfaceIPC
{
	protected $channel;

	public function __construct($config=false)
	{
		$this->channel = 1;
		parent::__construct($config);
	}

	public function read()
	{
		$this->connect();
		msg_receive($this->resource, $this->channel, $msgtype, $this->size, $data);
		return $data;
	}

	public function send($data, $channel=false)
	{
		$channel = $channel ? $channel : $this->channel;
		$this->connect();
		msg_send($this->resource, $channel, $data);
		return $this;
	}

	public function close() { return $this; }
	public function release()
	{
		msg_remove_queue($this->resource);
		$this->shm = false;
		return $this;
	} 
	
	protected function connect($force=false)
	{
		if($this->mode != "persistent" || $force || !$this->resource ) // || !msg_queue_exists($this->resource)
			$this->resource = msg_get_queue($this->id) ;
	}

	protected function update($data)
	{
		$status = $this->getInfo();
		if($status['msg_qnum'] > 0){
			$this->notify(trim($data));
		}
	}

	public function getInfo(){
		return msg_stat_queue( $this->resource );
	}
}
