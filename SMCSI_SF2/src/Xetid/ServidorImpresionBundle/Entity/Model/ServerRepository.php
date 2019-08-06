<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 19/03/15
 * Time: 14:03
 */

namespace Xetid\ServidorImpresionBundle\Entity\Model;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ServerRepository extends EntityRepository{

    public function loadConfigServer(){
        $connet = $this->getEntityManager()->getConnection();
        $query = "SELECT denomination, place, supporter, serialnumber FROM server";
        $data = $connet->executeQuery($query);
        $count = count($data->fetchAll(Query::HYDRATE_ARRAY));
        $query  = $connet->executeQuery($query);
        //var_dump($query->fetchAll(Query::HYDRATE_ARRAY));die;
        $arrays = $query->fetchAll(Query::HYDRATE_ARRAY);
        return $arrays;

    }


    public function updateConfigServer($arrayParameter){
        $denominacion = $arrayParameter['denominacion'];
        $noInventario = $arrayParameter['noInventario'];
        $local = $arrayParameter['local'];
        $operario = $arrayParameter['operario'];
        $query = "UPDATE server SET denomination='$denominacion',place='$local', supporter='$operario', serialnumber='$noInventario'";
        $connet = $this->getEntityManager()->getConnection();
        $connet->executeUpdate($query);
    }



} 