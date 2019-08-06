<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
abstract class BasePrintergroupsmembers extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('mod_pykota.printergroupsmembers');
        $this->hasColumn('groupid', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('printerid', 'int4', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('printersserverid', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
        $this->hasColumn('printersserverid2', 'varchar', null, array('notnull' => true, 'primary' => true, 'sequence' => ''));
    }
    public function setUp() {
        parent::setUp();
        $this->hasMany('Printers', array('local' => 'printerid', 'foreign' => 'id'));
        $this->hasMany('Printers as PrintGroup', array('local' => 'groupid', 'foreign' => 'id'));
    }
}
?>
