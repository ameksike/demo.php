<?php
/**
 * Billingcodes
 *
 * This class has been generated by ZeolIDE
 *
 * @author Equipo de desarrollo Linea Marco Trabajo
 * @version $Rev:$
 */

class Billingcodes extends BaseBillingcodes {
	public function setUp() {
		parent::setUp();
	}

	public static function getAll() {
		$query = Doctrine_Query::Create();
      	$result = $query->select('x.*')
          				->from('Billingcodes x')
          				->fetchArray();
      	return $result;
	}
	
	public static function getById($id) {
        return Doctrine::getTable('Billingcodes')->find($id);
    }
}
?>