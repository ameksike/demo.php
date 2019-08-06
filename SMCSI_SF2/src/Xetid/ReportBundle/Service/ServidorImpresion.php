<?php
/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		05/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
namespace Xetid\ReportBundle\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ServidorImpresion extends Controller
{
	public function __construct($container){
		$this->container = $container;
	}

    public function getPrinterList(){
        $request  = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $filtre= $request->query->get('filtre');
		$em = $this->getDoctrine()->getManager();
		
		
		$arrays = array();
        $not_group_printer = $em->getRepository('ServidorImpresionBundle:Printers')->findAllPrinters($start,$limit, $filtre);

        foreach($not_group_printer['data'] as $printer){
				$namegroup = $em->getRepository('ServidorImpresionBundle:Printers')
								->findGrupoNameByIdPrinter($printer['id']);
								
                array_push($arrays,array(
                        'id'=>$printer['id'],
                        'text'=>$printer['printername'],
                        'leaf'=>true,
                        'printername'=>$printer['printername'],
                        'description'=>$printer['description'],
                        'priceperpage' =>$printer['priceperpage'],
                        'priceperjob' =>$printer['priceperjob'],
                        'maxjobsize'=>$printer['maxjobsize'],
                        'groupname'=>(!is_null($namegroup)) ? $namegroup : "",
                        'isgroup' => (!is_null($namegroup)) ? true : false,
                ));
        }
		return $arrays;
	}
	
	public function getUserList(){
        $request  = $this->get('request');
        $limit = $request->query->get('limit');
        $start = $request->query->get('start');
        $filtre = $request->query->get('filtre');
        $em = $this->getDoctrine()->getManager();
        
        $users = $em->getRepository("ServidorImpresionBundle:Users")
					->findAllUser($start, $limit, $filtre);
					
        $arrays = array();
        foreach($users['data'] as $key => $user){
            $total = $em->getRepository("ServidorImpresionBundle:Jobhistory")
                ->getGastoTotalByUser($user['id']);
            $groupname = $em->getRepository("ServidorImpresionBundle:Groups")
                ->findGrupoByUser($user['id']);
            $tmp = array(
                'text'=>$user['username'],
                'leaf'=>true,
                'id'=>$user['id'],
                'username'=>$user['username'],
                'description'=>$user['description'],
                'overcharge' => $user['overcharge'],
                'lifetimepaid' => (!is_null($total)) ? $total : 0,
                'groupname'=> (!is_null($groupname)) ? $groupname : "",
                'isgroup' => (!is_null($groupname)) ? true : false,
            );
            array_push($arrays,$tmp);
        }
        return $arrays;
    }
    
    public function getJobHistory(){
        $request  = $this->get('request');
        $start  = $request->query->get('start');
        $limit  = $request->query->get('limit');
        $start  = $start ? $start : 0;
        $limit  = $limit ? $limit : 5000;
        $json = $request->query->get('json');
        $arrays = json_decode($json,true);
        $em = $this->getDoctrine()->getManager();
        
        $jobhistory = $em->getRepository('ServidorImpresionBundle:Jobhistory')->findAllJobHistory($start,$limit,$arrays);
        $arrays = array();
        $total = 0;
        foreach($jobhistory['data'] as $job){
            $action = 'Cancelado';
            switch($job['action']){
                case 'ALLOW':
                    $action = 'Permitido';
                    break;
                case 'DENY':
                    $action = 'Denegado';
                    break;
                case 'WARN':
                    $action = 'Advertencia';
                    break;
            }
            $idgrupo = $job['groupid'];
            $printer = $em->getRepository('ServidorImpresionBundle:Printers')->findOneById($idgrupo);
            $tmp = array(
                'id'=>$job['id'],
                'user'=>$job['username'],
                'name' => $job['description'],
                'idusuario'=>$job['idusuario'],
                'action'=>$action,
                'impresora'=>$job['printername'],
                'pag'=>$job['jobsize'],
                'priceperpage' => $job['priceperpage'],
                'priceperjob'=>$job['priceperjob'],
                'costo'=>$job['jobprice'],
                'dirip'=>$job['hostname'],
                'fecha'=>$job['jobdate'],
                'copy'=>$job['copies'],
                'pages'=>$job['pages'],
                'filename'=>$job['filename'],
                'title'=>$job['title'],
                'groupname' => $job['groupname'],
                'groupprinter'=> $printer->getPrintername()
            );
            array_push($arrays,$tmp);
        }
       return $arrays;
    }    
    
    public function loadServerConfig()
    {
        $em = $this->getDoctrine()->getManager();
        $serverConfig = $em->getRepository('ServidorImpresionBundle:Server')->loadConfigServer();
        $denominacion = $serverConfig[0]['denomination'];
        $noInventario = $serverConfig[0]['serialnumber'];
        $local = $serverConfig[0]['place'];
        $operario = $serverConfig[0]['supporter'];
        return array(
			'iddenominacion' =>$denominacion,
			'idNoInventario'=>$noInventario,
			'idlocal'=>$local,
			'idoperario'=>$operario
		);
    }
}
