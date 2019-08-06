<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BasePrinters extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.printers');
        $this->hasColumn('id', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => 'mod_pykota.printers_id_seq1'));
        $this->hasColumn('printername', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('description', 'text', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('priceperpage', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('priceperjob', 'float8', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('passthrough', 'bool', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('maxjobsize', 'int4', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('isgroups', 'bool', null, array('notnull' => true, 'primary' => false));
        $this->hasColumn('serverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Coefficients', array('local' => 'printerid', 'foreign' => 'id'));
        $this->hasMany('Server', array('local' => 'serverid', 'foreign' => 'id'));
        $this->hasMany('Printergroupsmembers', array('local' => 'id', 'foreign' => 'printerid'));
    }
}
?>
