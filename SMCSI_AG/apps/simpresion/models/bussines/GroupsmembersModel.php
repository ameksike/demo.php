<?php
/**
 * Groupsmembers
 *
 * This class has been generated by ZeolIDE
 *
 * @author Equipo de desarrollo Linea Marco Trabajo
 * @version $Rev:$
 */
class GroupsmembersModel extends ZendExt_Model {

    public function GroupsmembersModel() {
        parent::ZendExt_Model();
    }

    public function adicionarGroupsmembers($instance) {
        $instance->save();
        return true;
    }

    public function modificarGroupsmembers($instance) {
        $instance->save();
        return true;
    }

    public function eliminarGroupsmembers($instance) {
        $instance->delete();
        return true;
    }
}