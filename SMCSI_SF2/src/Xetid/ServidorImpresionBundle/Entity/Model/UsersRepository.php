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

class UsersRepository extends EntityRepository{

    public function findUserNotGroup($start=0,$limit=5){
        $connet = $this->getEntityManager()->getConnection();
        $query = "SELECT id, username, email, balance, lifetimepaid, limitby, description,overcharge FROM users WHERE id not in (SELECT userid FROM groupsmembers)";
        $data = $connet->executeQuery($query);
        $count = count($data->fetchAll(Query::HYDRATE_ARRAY));
        if(!is_null($start) && !is_null($limit)){
            $query .= " OFFSET $start LIMIT $limit;";
        }
        $query  = $connet->executeQuery($query);
        $arrays = array(
            'data'=>$query->fetchAll(Query::HYDRATE_ARRAY),
            'data_count'=>$count
        );
        return $arrays;

    }

    public function findAllUser($start = 0, $limit = 5, $filtre = null)
    {
        $connet = $this->getEntityManager()
            ->getConnection();
        $query =
            "SELECT id, username, email, balance, lifetimepaid, limitby, description,overcharge FROM users";

        if(!is_null($filtre)){
            $query .= " WHERE username like '%$filtre%'";
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

    public function findUserssByName($usersname){
        $cqb = $this->getEntityManager()->createQueryBuilder();
        $cqb->select('u')->from("ServidorImpresionBundle:Users","u")->where("u.username =:username")->setParameter("username",$usersname);
        $result = $cqb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }

    public function findTotalPriceForUser($iduser){
            $sql = "SELECT u.id as id, username, email, balance, lifetimepaid, limitby, description,overcharge, SUM(j.jobprice) as precio, SUM(j.jobsize) totalPage
                    FROM users u ,userpquota uq,jobhistory j
                    WHERE u.id = uq.userid AND uq.userid = j.userid AND u.id = $iduser GROUP BY u.id";
        $connet = $this->getEntityManager()->getConnection();
        $query = $connet->executeQuery($sql);
        return $query->fetchAll(Query::HYDRATE_ARRAY);
    }

    public function updateUser($arrayParameter){
        $id = $arrayParameter['id'];
        $username = $arrayParameter['username'];
        $description = $arrayParameter['description'];
        $overcharge = $arrayParameter['overcharge'];
        $query = "UPDATE users SET username='$username',description='$description', overcharge=$overcharge WHERE id = $id";
        $connet = $this->getEntityManager()->getConnection();
        $connet->executeUpdate($query);
    }



} 