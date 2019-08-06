<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 19/03/15
 * Time: 9:34
 */

namespace Xetid\ServidorImpresionBundle\Entity\Model;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class GroupsRepository extends EntityRepository{

    public function findUersbyIdGroup($id){
        $cqb = $this->getEntityManager()->createQueryBuilder();
        $cqb->select('g','gm','u')->from("ServidorImpresionBundle:Groups","g")->join("g.userid","gm")->join("gm.groupid","u")->where("g.id =:idgrupo")->setParameter("idgrupo",$id);
        return $cqb->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function findQuotasGroups($groupname){
        $cqb = $this->getEntityManager()->createQueryBuilder();
        $cqb->select('gq','g','p')->from("ServidorImpresionBundle:Grouppquota","gq")->join("gq.groupid","g")
            ->join("gq.printerid","p")->where("g.groupname =:groupname")->setParameter("groupname",$groupname);
        $result = $cqb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }

    public function findGroupsByName($groupname){
        $cqb = $this->getEntityManager()->createQueryBuilder();
        $cqb->select('g')->from("ServidorImpresionBundle:Groups","g")->where("g.groupname =:groupname")->setParameter("groupname",$groupname);
        $result = $cqb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }

    public function findGrupoByUser($iduser)
    {
        $sql = "SELECT g.groupname as groupname
 FROM users u,groups g,groupsmembers gm
 WHERE u.id = gm.userid AND gm.groupid = g.id AND u.id = $iduser";
        $connet = $this->getEntityManager()
            ->getConnection();
        $query = $connet->executeQuery($sql);
        $arrays = $query->fetchAll(Query::HYDRATE_ARRAY);
        return (count($arrays) > 0) ? $arrays[0]['groupname'] : null;
    }
    public function findQuotaAndGastoForPrinterByGrupo($groupid, $start = null,$limit = null){
        $query = "SELECT p.printername as printername,gq.hardlimit as cuota,SUM(uq.pagecounter) as consumido
  FROM printers p,grouppquota gq,userpquota uq,groupsmembers gm
  WHERE gq.groupid = $groupid AND gq.printerid = uq.printerid AND gq.groupid = gm.groupid AND gm.userid = uq.userid AND gq
  .printerid = p.id
  GROUP BY p.printername, gq.hardlimit";
        if(!is_null($start) && !is_null($limit)){
            $query.=" OFFSET $start LIMIT $limit";
        }
        $connet = $this->getEntityManager()
            ->getConnection();
        $query = $connet->executeQuery($query);
        $arrays = $query->fetchAll(Query::HYDRATE_ARRAY);
        return $arrays;
    }


} 