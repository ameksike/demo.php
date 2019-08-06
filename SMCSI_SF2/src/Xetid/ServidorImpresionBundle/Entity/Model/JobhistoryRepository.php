<?php
/**
 * Created by PhpStorm.
 * User: jmzaldivar
 * Date: 13/03/15
 * Time: 11:18
 */

namespace Xetid\ServidorImpresionBundle\Entity\Model;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Xetid\ServidorImpresionBundle\Utils\Utils;

class JobhistoryRepository extends EntityRepository{

    public function findAllJobHistory($start=0,$limit=5, $filters = array()){
        $connet = $this->getEntityManager()->getConnection();
        $selet = "SELECT j.id as id, jobid, j.pagecounter as pagecounter , jobsizebytes, jobsize,jobprice,
                         action, filename, title, copies, options, hostname, md5sum, pages, billingcode, precomputedjobsize,
                        precomputedjobprice,jobdate,u.id as idusuario,u.username as username,
                        u.description as description,p.id as idprinters,
                        p.printername as printername,p.priceperpage as priceperpage,p.priceperjob as priceperjob,
                        g.groupname as groupname, pm.groupid as groupid";
        $form = "FROM jobhistory j,userpquota uq ,users u,printers p,groupsmembers gm,groups g,
        printergroupsmembers pm";

        $where = "WHERE j.userid = uq.userid AND uq.userid = u.id AND uq.printerid = p.id AND j.printerid = p.id
        AND u.id = gm.userid AND gm.groupid = g.id AND p.id = pm.printerid";

        if(count($filters) > 0){
            $isfecha = false;
            if(isset($filters['filter'])){
                switch($filters['filter']){
                    case 'ayer':
                        $dia_Ayer= date('Y-m-d', strtotime('-1 day'));
                        $dia_hoy = date('Y-m-d');
                        $where .= " AND j.jobdate >= '$dia_Ayer' AND j.jobdate < '$dia_hoy'";
                        $isfecha = true;
                        break;
                    case 'este_anno':
                        $year = date('Y');
                        $primer_dia = "1-01-$year";
                        $ultimo_dia = "31-12-$year";
                        $where .= " AND j.jobdate >= '$primer_dia' AND j.jobdate <= '$ultimo_dia'";
                        $isfecha = true;
                        break;
                    case 'este_mes':
                        $mes = date('m');
                        $year = date('Y');
                        $dia = 30;
                        switch($mes){
                            case '02':
                                if(($year % 4 == 0 && $year % 100 != 0) || ($year % 100 == 0 && $year % 400 == 0)){
                                    $dia = 29;
                                }else{
                                    $dia = 28;
                                }
                                break;
                            case '01':
                            case '03':
                            case '05':
                            case '07':
                            case '08':
                            case '10':
                            case '12':
                                $dia = 31;
                                break;

                        }
                        $primer_dia = "1-$mes-$year";
                        $ultimo_dia = "$dia-$mes-$year";
                        $where .= " AND j.jobdate >= '$primer_dia' AND j.jobdate <= '$ultimo_dia'";
                        $isfecha = true;
                        break;
                    case 'hoy':
                        $dia_hoy = date('Y-m-d');
                        $where .= " AND j.jobdate = '$dia_hoy'";
                        $isfecha = true;
                        break;
                    case 'ultimo_siete_dia':
                        $ultimo_siete_dia= date('Y-m-d', strtotime('-7 day'));
                        $dia_hoy = date('Y-m-d');
                        $where .= " AND j.jobdate >= '$ultimo_siete_dia' AND j.jobdate <= '$dia_hoy'";
                        $isfecha = true;
                        break;
                }
            }

            if(isset($filters['idGroupUser']) && $filters['idGroupUser'] != "" && is_int($filters['idGroupUser'])){
               $idGroupuser = $filters['idGroupUser'];
                //$form .= ",groups g,groupsmembers gm";
                $where .=" AND u.id = gm.userid AND gm.groupid = $idGroupuser";
            }
            if(isset($filters['usuario']) && $filters['usuario'] != ""){
                $name = $filters['usuario'];
                $where .= " AND u.username like '$name'";
            }
            if(isset($filters['action']) && $filters['action']!=""){
                $action = $filters['action'];
                $where .= " AND j.action like '%$action%'";
            }
            if(isset($filters['printer']) && $filters['printer']!="" && is_int($filters['printer'])){
                $printer = $filters['printer'];
                $where .= " AND p.id = $printer";
            }
            if(isset($filters['date']) && $filters['date']!= "" && !$isfecha){
                $date = $filters['date'];
               // $date = explode('/',$date);
                //$where .= " AND j.jobdate = '$date[2]-$date[0]-$date[1]'";
                $where .= " AND j.jobdate = '$date'";
            }
            if(isset($filters['idGroupPrinters']) && $filters['idGroupPrinters'] != "" && is_int($filters['idGroupPrinters'])){
                $idGroupPrinters = $filters['idGroupPrinters'];
                $form .=",printergroupsmembers pg";
                $where .= " AND p.id = pg.printerid AND pg.groupid = $idGroupPrinters";
            }

        }
        $query = $selet." ".$form." ".$where;
        $result = $connet->executeQuery($query);
        $count = count($result->fetchAll(Query::HYDRATE_ARRAY));
        $data = $connet->executeQuery($query." ORDER BY id DESC OFFSET $start LIMIT $limit");
        $array = $data->fetchAll(Query::HYDRATE_ARRAY);
        return array("data" =>$array,"count"=>$count);
    }
    public function getGastoTotalByUser($userid){
        $connet = $this->getEntityManager()
            ->getConnection();
        $query = "SELECT SUM(jobprice) as total FROM jobhistory Where userid = $userid";
        $query = $connet->executeQuery($query);
        $arrays = $query->fetchAll(Query::HYDRATE_ARRAY);
        return $arrays[0]['total'];
    }
} 