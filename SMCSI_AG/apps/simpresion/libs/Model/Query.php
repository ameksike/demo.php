<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	model
 * @date		20/07/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
include dirname(__FILE__)."/lql/LQL.php";
include dirname(__FILE__)."/lql/LQLProcessorSQL.php";

class Model_LQL_Executor_Doctrine extends LQLExecutor
{
	public function execute($data){
		return Doctrine_Manager::getInstance()
				->getCurrentConnection()
				->fetchAll($data);
	}
}

class Model_Query extends LQL
{
	public function __construct(){
		parent::__construct(
			new Model_LQL_Executor_Doctrine(),
			new LQLProcessorSQL()
		);
		
	}
}
