<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
class Users extends BaseUsers {
	public function setUp() {
		parent::setUp();
	}

	public static function getAll() {
		$query = Doctrine_Query::Create();
      	$result = $query->select('x.*')
          				->from('Users x')
          				->fetchArray();
      	return $result;
	}
	
	public static function getById($id) {
        return Doctrine::getTable('Users')->find($id);
    }

    public function getStatistic(){
        return $this->query4statistic()->fetchArray();
    }

    public function query4statistic(){
        return Doctrine_Query::Create()
            ->select('
                    u.username as user,
                    count(j.id) as work,
                    sum(j.jobsize) as page
            ')
            ->addSelect("(SELECT count(j1.id) FROM Jobhistory j1 WHERE j1.action = 'ALLOW' ) as allow")
            ->addSelect("(SELECT count(j2.id) FROM Jobhistory j2 WHERE j2.action = 'DENY' ) as deny")
            ->addSelect("(SELECT count(j3.id) FROM Jobhistory j3 WHERE j3.action = 'WARN' ) as warn")
            ->from('Users u')
            ->innerJoin('u.Jobhistory j')
            ->groupBy('u.id, u.username')
            ;
    }
}
/*
SELECT
	u.serverid,
	u.id,
	u.username as user,
	count(j.id) as work,
	sum(jobsize) as page,
	(
		SELECT count(j1.userid)
		FROM mod_pykota.jobhistory j1
		INNER JOIN mod_pykota.users u1 ON u1.id = j1.userid
		WHERE j1.action = 'ALLOW' AND j1.userid = u.id AND u1.serverid = u.serverid
		GROUP BY j1.userid, u1.username, u1.serverid
	) as allow,
	(
		SELECT count(j1.userid)
		FROM mod_pykota.jobhistory j1
		INNER JOIN mod_pykota.users u1 ON u1.id = j1.userid
		WHERE j1.action = 'DENY' AND j1.userid = u.id AND u1.serverid = u.serverid
		GROUP BY j1.userid, u1.username, u1.serverid
	) as deny,
	(
		SELECT count(j1.userid)
		FROM mod_pykota.jobhistory j1
		INNER JOIN mod_pykota.users u1 ON u1.id = j1.userid
		WHERE j1.action = 'WARN' AND j1.userid = u.id AND u1.serverid = u.serverid
		GROUP BY j1.userid, u1.username, u1.serverid
	) as warn


FROM mod_pykota.jobhistory j
LEFT JOIN mod_pykota.users u ON u.id = j.userid
GROUP BY j.userid, u.username, u.serverid, u.id;
*/