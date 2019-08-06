<?php
/**
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		21/06/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
class ServerModel extends Model_Automatic {
    public function getAll(){
        $server = new Server();
        $data = $server->getAll();
        foreach($data as $k=>$i){
            $data[$k]['children'] = array(
                array("text"=>'Grupo de usuarios',"expanded"=> true, "children"=>(new GroupsModel())->findAll($i['id'])),
                array("text"=>'Grupo de impresoras',"expanded"=> true, "children"=>(new PrintersModel())->findAll($i['id'])),
            );
        }
        return $data;
    }
}