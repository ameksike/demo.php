<?php
/**
 * Payments
 *
 * This class has been generated by ZeolIDE
 *
 * @author Equipo de desarrollo Linea Marco Trabajo
 * @version $Rev:$
 */
class PaymentsModel extends ZendExt_Model {

    public function PaymentsModel() {
        parent::ZendExt_Model();
    }

    public function adicionarPayments($instance) {
        $instance->save();
        return true;
    }

    public function modificarPayments($instance) {
        $instance->save();
        return true;
    }

    public function eliminarPayments($instance) {
        $instance->delete();
        return true;
    }
}