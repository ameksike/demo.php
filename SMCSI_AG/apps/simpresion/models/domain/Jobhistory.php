<?php
/**
 * @author        Antonio Membrides Espinosa
 * @package        simpresion
 * @date        21/06/2015
 * @copyright    Copyright (c) 2015-2015 XETID
 * @license        XETID
 * @version        1.0
 */
class Jobhistory extends BaseJobhistory
{
    public function query4statistic($table = 'users', $fname = 'username', $fid = 'userid')
    {
        $query = Model_Query::create()
            ->select("
                u.serverid,
                u.id as uid,
                count(j.id) as work,
                sum(jobsize) as page
            ")
            ->addSelect("u.$fname", $table)
            ->addSelect(Model_Query::create()
                    ->select("count(j1.$fid)")
                    ->from('mod_pykota.jobhistory j1')
                    ->innerJoin("mod_pykota.$table u1", ' u1.id', "j1.$fid")
                    ->where("j1.action", 'ALLOW')
                    ->andWhere("j1.$fid = u.id")
                    ->andWhere('j1.serverid = u.serverid')
                    ->groupBy("j.$fid, u.$fname, u.serverid, u.id"),
                "allow"
            )
            ->addSelect(Model_Query::create()
                    ->select("count(j1.$fid)")
                    ->from('mod_pykota.jobhistory j1')
                    ->innerJoin("mod_pykota.$table u1", ' u1.id', "j1.$fid")
                    ->where("j1.action", 'DENY')
                    ->andWhere("j1.$fid = u.id")
                    ->andWhere('j1.serverid = u.serverid')
                    ->groupBy("j.$fid, u.$fname, u.serverid, u.id"),
                "deny"
            )
            ->addSelect(Model_Query::create()
                    ->select("count(j1.$fid)")
                    ->from('mod_pykota.jobhistory j1')
                    ->innerJoin("mod_pykota.$table u1", ' u1.id', "j1.$fid")
                    ->where("j1.action", 'WARN')
                    ->andWhere("j1.$fid = u.id")
                    ->andWhere('j1.serverid = u.serverid')
                    ->groupBy("j.$fid, u.$fname, u.serverid, u.id"),
                "warn"
            )
            ->addSelect(Model_Query::create()
                    ->select("count(j1.$fid)")
                    ->from('mod_pykota.jobhistory j1')
                    ->innerJoin("mod_pykota.$table u1", ' u1.id', "j1.$fid")
                    ->where("j1.action", 'CANCEL')
                    ->andWhere("j1.$fid = u.id")
                    ->andWhere('j1.serverid = u.serverid')
                    ->groupBy("j.$fid, u.$fname, u.serverid, u.id"),
                "cancel"
            )
            ->from('mod_pykota.jobhistory j')
            ->innerJoin("mod_pykota.$table u ", 'u.id', "j.$fid")
            ->groupBy("j.$fid, u.$fname, u.serverid, u.id");
        return $query;
    }

    public function query4getAll()
    {
        return Model_Query::create()
            ->select('
                    j.id as uid,
                    j.serverid as serverid,
                    u.username as user,
                    j.action as action,
                    p.printername as impress,
                    j.jobsize as page,
                    p.priceperjob as work,
                    j.jobprice as total,
                    j.hostname as ip,
                    j.jobdate as date,

                    j.title as title,
                    ug.groupname as guser,
                    pg.printername as gprinter,
                    u.description as fullname
            ')
            ->from('mod_pykota.jobhistory j')
            ->leftJoin('mod_pykota.users u', 'u.id', 'j.userid')
            ->leftJoin('mod_pykota.groupsmembers mug', 'mug.userid', 'u.id')
            ->leftJoin('mod_pykota.groups ug', 'mug.groupid', 'ug.id')
            ->leftJoin('mod_pykota.printers p', 'j.printerid', 'p.id')
            ->leftJoin('mod_pykota.printergroupsmembers mpg', 'mpg.printerid', 'p.id')
            ->leftJoin('mod_pykota.printers pg', 'pg.id', 'mpg.groupid')
            ->leftJoin('mod_pykota.server s', 's.id', 'j.serverid');
    }

    public function query4chart($cfg = array())
    {
        $query = (new Doctrine_Query())->from('Jobhistory j');
        if (isset($cfg['where'])) {
            foreach ($cfg['where'] as $k => $i)
                $query->andWhere("$k like '%$i%'");
        }
        return $query;
    }

    public function setFilter($cfg, $query)
    {
        if (isset($cfg['offset']))
            $query->offset($cfg['offset']);

        if (isset($cfg['limit']))
            $query->limit($cfg['limit']);

        $query->where("true");

        if (isset($cfg['where']))
            foreach ($cfg['where'] as $k => $i)
                $query->andWhere($i[0], $i[1], $i[2]);

        if (isset($cfg['datein']))
            $query->andWhere("j.jobdate", $cfg['datein'], '>=');
        if (isset($cfg['dateout']))
            $query->andWhere("j.jobdate", $cfg['dateout'], '<=');

        return $query;
    }

    public function getAll($cfg)
    {
        $cfg['where'][] = array('s.active', true, '=');
        return $this->setFilter($cfg, $this->query4getAll())->fetchArray();
    }

    public function getAllCount($cfg)
    {
        $cfg['where'][] = array('s.active', true, '=');
        unset($cfg['limit'], $cfg['offset']);

        $data = Model_Query::create()
            ->select(" count(t.user) AS total")
            ->from($this->setFilter($cfg, $this->query4getAll()), 't')
            ->fetchArray();
        return $data[0]['total'];
    }

    public function getStatistic($cfg, $table = 'users', $fname = 'username', $fid = 'userid')
    {
        return $this->setSuport($this->setFilter($cfg, $this->query4statistic($table, $fname, $fid)))->fetchArray();
    }

    public function getStatistiCount($cfg, $table = 'users', $fname = 'username', $fid = 'userid')
    {
        unset($cfg['limit'], $cfg['offset']);
        $data = Model_Query::create()
            ->select(" count(t.work) AS total")
            ->from($this->setSuport($this->setFilter($cfg, $this->query4statistic($table, $fname, $fid))), 't')
            ->fetchArray();
        return $data[0]['total'];
    }

    public function getActions()
    {
        return (new Doctrine_Query())
            ->select('t.action as action')
            ->from('Jobhistory t')
            ->groupBy('t.action')
            ->fetchArray();
    }

    public function getChartAccion($cfg = null)
    {
        $cfg['where'][] = array('s.active', true, '=');
        $query = Model_Query::create()
            ->select('count(j.action) as data1, j.action as name')
            ->from('mod_pykota.jobhistory j')
            ->innerJoin('mod_pykota.server s', 's.id', 'j.serverid')
            ->groupBy('j.action');
        return $this->setFilter($cfg, $this->setSuport($query))->fetchArray();
    }

    public function getChartCosto($cfg = null)
    {
        $cfg['where'][] = array('s.active', true, '=');
        $query = Model_Query::create()
            ->select('SUM(j.jobprice) as data1, s.denomination as name')
            ->from('mod_pykota.jobhistory j')
            ->innerJoin('mod_pykota.server s', 's.id', 'j.serverid')
            ->groupBy('j.serverid, s.denomination');
        return $this->setFilter($cfg, $this->setSuport($query))->fetchArray();
    }

    public function getChartImpresion($cfg = null)
    {
        $cfg['where'][] = array('s.active', true, '=');
        $query = Model_Query::create()
            ->select('count(j.action) as data1, s.denomination as name')
            ->from('mod_pykota.jobhistory j')
            ->innerJoin('mod_pykota.server s', 's.id', 'j.serverid')
            ->addWhere("j.action", 'ALLOW')
            ->groupBy('j.serverid, s.denomination');
        return $this->setFilter($cfg, $this->setSuport($query))->fetchArray();
    }

    public function getChartSolicitud($cfg = null)
    {
        $cfg['where'][] = array('s.active', true, '=');
        $query = Model_Query::create()
            ->select('count(j.id) as data1, s.denomination as name')
            ->from('mod_pykota.jobhistory j')
            ->innerJoin('mod_pykota.server s', 's.id', 'j.serverid')
            ->groupBy('j.serverid, s.denomination');
        return $this->setFilter($cfg, $this->setSuport($query))->fetchArray();
    }

    public function setSuport($query)
    {
        return $query
            /* soporte para busqueda por grupos de impresora*/
            ->innerJoin('mod_pykota.printers p', 'p.id', 'j.printerid')
            ->innerJoin('mod_pykota.printergroupsmembers mpg', 'mpg.printerid', 'p.id')
            ->innerJoin('mod_pykota.printers pg', 'pg.id', 'mpg.groupid')
            /* soporte para busqueda por grupos de usuario*/
            ->innerJoin('mod_pykota.users us', 'us.id', 'j.userid')
            ->innerJoin('mod_pykota.groupsmembers mug', 'mug.userid', 'us.id')
            ->innerJoin('mod_pykota.groups ug', 'mug.groupid', 'ug.id');
    }
}
