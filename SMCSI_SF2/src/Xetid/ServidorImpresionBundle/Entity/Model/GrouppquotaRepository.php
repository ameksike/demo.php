<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 26/03/15
 * Time: 11:24
 */

namespace Xetid\ServidorImpresionBundle\Entity\Model;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class GrouppquotaRepository extends EntityRepository{

    public function findGuotaByIdprinterAndIdidGrupo($idGrupo,$idPrinter){
        $connet = $this->getEntityManager()->getConnection();
        $query = "SELECT id, groupid, printerid, softlimit, hardlimit, maxjobsize, datelimit FROM grouppquota WHERE groupid = $idGrupo AND printerid = $idPrinter";
        $query  = $connet->executeQuery($query);
        return $query->fetchAll(Query::HYDRATE_ARRAY);
    }
} 