<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 13/03/15
 * Time: 15:19
 */
namespace Xetid\ServidorImpresionBundle\Entity\Model;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
//use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;

class PrintersRepository extends EntityRepository
{
    public function findAllPrinters($start = null, $limit = null, $filtre = null)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query =
            "SELECT id, printername, description, priceperpage, priceperjob, passthrough, maxjobsize, isgroups FROM printers WHERE isgroups = false";
        if (!is_null($filtre)) {
            $query .= " AND printername like '%$filtre%'";
        }
        $data = $connet->executeQuery($query);
        $count = count($data->fetchAll(Query::HYDRATE_ARRAY));
        if (!is_null($start) && !is_null($limit)) {
            $query .= " OFFSET $start LIMIT $limit;";
        }
        $query = $connet->executeQuery($query);
        $arrays = array('data' => $query->fetchAll(Query::HYDRATE_ARRAY), 'data_count' => $count);

        return $arrays;
    }

    public function findPrinterNotGroup($start = null, $limit = null)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query =
            "SELECT id, printername, description, priceperpage, priceperjob, passthrough, maxjobsize FROM printers WHERE  isgroups = false AND id not in(SELECT printerid FROM printergroupsmembers)";
        $data = $connet->executeQuery($query);
        $count = count($data->fetchAll(Query::HYDRATE_ARRAY));
        if (!is_null($start) && !is_null($limit)) {
            $query .= " OFFSET $start LIMIT $limit;";
        }
        $query = $connet->executeQuery($query);
        $arrays = array('data' => $query->fetchAll(Query::HYDRATE_ARRAY), 'data_count' => $count);

        return $arrays;
    }

    public function findGroupPrinter($start = null, $limit = null)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        //$query = "SELECT id, printername, description, priceperpage, priceperjob, passthrough,maxjobsize FROM printers,printergroupsmembers WHERE id = groupid  group by id";;
        $query =
            "SELECT id, printername, description, priceperpage, priceperjob, passthrough,maxjobsize, isgroups FROM printers WHERE isgroups = true";
        if (!is_null($start) && !is_null($limit)) {
            $query .= " OFFSET $start LIMIT $limit";
        }
        $query = $connet->executeQuery($query);

        return $query->fetchAll(Query::HYDRATE_ARRAY);
    }

    public function findPrinterByGrupo($id, $start = null, $limit = null)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query =
            "SELECT id, printername, description, priceperpage, priceperjob, passthrough,maxjobsize FROM printers p,printergroupsmembers pm WHERE id = pm.printerid AND pm.groupid = $id";
        if (!is_null($start) && !is_null($limit)) {
            $query .= " OFFSET $start LIMIT $limit";
        }
        $query = $connet->executeQuery($query);

        return $query->fetchAll(Query::HYDRATE_ARRAY);
    }

    public function findGrupoNameByIdPrinter($id)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query =
            "SELECT groupid, printerid,p.printername as printername FROM printergroupsmembers pg,printers p WHERE printerid = $id AND groupid
=p.id";
        $query = $connet->executeQuery($query);
        $arrays = $query->fetchAll(Query::HYDRATE_ARRAY);
        return (count($arrays) > 0) ? $arrays[0]['printername'] : null ;
    }

    public function updateGroupPrinter($id,$name,$description)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query = "UPDATE printers SET printername='$name', description='$description' WHERE id = $id";
        try{
            $query = $connet->executeUpdate($query);
        } catch (\Exception $ee){
            return false;
        }
        return true;
    }
} 