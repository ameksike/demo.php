<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BaseUserpquota extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.userpquota');
        $this->hasColumn('id', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => 'mod_pykota.userpquota_id_seq1'));
        $this->hasColumn('userid', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('printerid', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('lifepagecounter', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('pagecounter', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('softlimit', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('hardlimit', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('datelimit', 'timestamp', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('maxjobsize', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('warncount', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('printersserverid', 'varchar', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('usersserverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Users', array('local' => 'userid', 'foreign' => 'id'));
    }
}
?>
