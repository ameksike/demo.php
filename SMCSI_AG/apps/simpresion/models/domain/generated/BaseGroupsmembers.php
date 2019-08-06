<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BaseGroupsmembers extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.groupsmembers');
        $this->hasColumn('groupid', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('userid', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('groupsserverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('usersserverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Groups', array('local' => 'groupid', 'foreign' => 'id'));
        $this->hasMany('Users', array('local' => 'userid', 'foreign' => 'id'));
    }
}
?>
