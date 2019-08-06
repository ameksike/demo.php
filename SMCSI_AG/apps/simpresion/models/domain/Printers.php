<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
class Printers extends BasePrinters
{
    public function findAll($serverid){
        $query = new Doctrine_Query();
        $result = $query
            ->select("p.id as tid, p.printername as text, true as leaf, 'pg' as field")
            ->from('Printers p')
            ->where('p.isgroups = true')
            ->addWhere("p.serverid = ?", $serverid)
            ->fetchArray();
        return $result;
    }
}