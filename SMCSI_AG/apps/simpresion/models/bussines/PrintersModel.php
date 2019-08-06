<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
class PrintersModel extends Model_Automatic {

    public function getAll(){
        $table = Doctrine::getTable('Printers');
        return $table->findAll(Doctrine::HYDRATE_ARRAY);
    }
}