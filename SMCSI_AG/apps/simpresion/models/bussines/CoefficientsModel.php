<?php
/**
 * Coefficients
 *
 * This class has been generated by ZeolIDE
 *
 * @author Equipo de desarrollo Linea Marco Trabajo
 * @version $Rev:$
 */
class CoefficientsModel extends ZendExt_Model {

    public function CoefficientsModel() {
        parent::ZendExt_Model();
    }

    public function adicionarCoefficients($instance) {
        $instance->save();
        return true;
    }

    public function modificarCoefficients($instance) {
        $instance->save();
        return true;
    }

    public function eliminarCoefficients($instance) {
        $instance->delete();
        return true;
    }
}