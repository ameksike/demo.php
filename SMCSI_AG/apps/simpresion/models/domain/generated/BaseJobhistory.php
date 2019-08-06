<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BaseJobhistory extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.jobhistory');
        $this->hasColumn('id', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => 'mod_pykota.jobhistory_id_seq1'));
        $this->hasColumn('jobid', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('userid', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('printerid', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('pagecounter', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('jobsizebytes', 'int8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('jobsize', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('jobprice', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('action', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('filename', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('title', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('copies', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('options', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('hostname', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('md5sum', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('pages', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('billingcode', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('precomputedjobsize', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('precomputedjobprice', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('jobdate', 'timestamp', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('serverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Server', array('local' => 'serverid', 'foreign' => 'id'));
        $this->hasMany('Users', array('local' => 'userid', 'foreign' => 'id'));
        $this->hasMany('Printers', array('local' => 'printerid', 'foreign' => 'id'));
    }
}