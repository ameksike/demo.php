<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BaseUsers extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.users');
        $this->hasColumn('id', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => 'mod_pykota.users_id_seq1'));
        $this->hasColumn('username', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('email', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('balance', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('lifetimepaid', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('limitby', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('description', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('overcharge', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('serverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Userpquota', array('local' => 'id', 'foreign' => 'userid'));
        $this->hasMany('Groupsmembers', array('local' => 'id', 'foreign' => 'userid'));
        $this->hasMany('Jobhistory', array('local' => 'id', 'foreign' => 'userid'));
    }
}
?>
