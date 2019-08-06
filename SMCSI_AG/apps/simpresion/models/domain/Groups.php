<?php
/**
 * @author        Antonio Membrides Espinosa
 * @package        simpresion
 * @date        21/06/2015
 * @copyright    Copyright (c) 2015-2015 XETID
 * @license        XETID
 * @version        1.0
 */
class Groups extends BaseGroups
{
    public function setUp()
    {
        parent::setUp();
    }

    public static function getAll()
    {
        $query = Doctrine_Query::Create();
        $result = $query->select('x.*')
            ->from('Groups x')
            ->fetchArray();
        return $result;
    }

    public function findAll($serverid)
    {
        $query = new Doctrine_Query();
        $result = $query
            ->select("g.id as tid, g.groupname as text, true as leaf, 'ug' as field")
            ->from('Groups g')
            ->where("g.serverid = ?", $serverid)
            ->fetchArray();
        return $result;
    }
}
