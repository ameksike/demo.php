<?php
/**
 * Coefficients
 *
 * This class has been generated by ZeolIDE
 *
 * @author Equipo de desarrollo Linea Marco Trabajo
 * @version $Rev:$
 */

class Coefficients extends BaseCoefficients {
	public function setUp() {
		parent::setUp();
	}

	public static function getAll() {
		$query = Doctrine_Query::Create();
      	$result = $query->select('x.*')
          				->from('Coefficients x')
          				->fetchArray();
      	return $result;
	}
	
	public static function getById($id) {
        return Doctrine::getTable('Coefficients')->find($id);
    }
}
?>
