<?php
/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		10/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
namespace Xetid\AlertBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xetid\AlertBundle\Entity\Alert;

class DefaultController extends Controller
{
    public function listAction()
    {
		$dto  = $this->getDTO();
		$limit = $this->getRequest()->get('limit', 15);
		$offset = $this->getRequest()->get('start', 0);
		$data = array(
			"success"=> true, 
			"count"=> $this->getRepository()->total($dto), 
			"data"=>$this->getRepository()->get($dto, $limit, $offset)
		);
        return new Response( json_encode($data) );
    }

    public function printerAction(){
		$list = array();
        $all = $this->getRepository('ServidorImpresionBundle:Printers')->findAllPrinters();
        foreach ($all['data'] as $printer) {
            $list[] = array(
                "text" => $printer['printername'],
                "id" => $printer['id']
            );
        }
		$data = array(
			"success"=> true, 
			"data"=> $list 
		);
        return new Response( json_encode($data) );
	}
	
    public function typeAction(){
		$data = array(
			"success"=> true, 
			"data"=>array(
				array("id"=> 1, 'text'=> 'Titulo contiene'),
				array("id"=> 2, 'text'=> 'Cantidad de páginas exedidas'),
				array("id"=> 3, 'text'=> 'Tiempo en cola exedido'),
				array("id"=> 4, 'text'=> 'Enviado por el usuario'),
				array("id"=> 5, 'text'=> 'Enviado por la pc'),
				array("id"=> 6, 'text'=> 'Fecha')
			)
		);
        return new Response( json_encode($data) );
	}
	    
    public function actionAction(){
		$data = array(
			"success"=> true, 
			"data"=>array(
				array("id"=> 1, 'text'=> 'Enviar correo electrónico'),
				array("id"=> 2, 'text'=> 'Ejecutar una aplicación'),
				array("id"=> 3, 'text'=> 'Cancelar un trabajo'),
				array("id"=> 4, 'text'=> 'Generar un reporte')
			)
		);
        return new Response( json_encode($data) );
	}
	
    public function deleteAction(){
		$dto  = $this->getDTO();
		$dto  = $this->getRepository()->dell($dto);
		$data = array( "success"=> true, "data"=>$dto[0] );
        return new Response( json_encode($data) );
	}
	
    public function editAction(){
		$dto  = $this->getDTO();
		$dto  = $this->getRepository()->edit($dto);
		$data = array( "success"=> true, "data"=>$dto[0] );
        return new Response( json_encode($data) );
	}
	
    public function addAction(){
		$dto  = $this->getDTO();
		$dto  = $this->getRepository()->add($dto);
		$data = array( "success"=> true, "data"=>$dto[0] );
		return new Response( json_encode($data) );
	}
	
	protected function getDTO(){
		$dto = $this->getRequest()->get('dto', '[]');
		return json_decode($dto, true);
	}
	
	protected function getRepository($name='XetidAlertBundle:Alert'){
			return $this->getDoctrine()->getManager()->getRepository($name);
	}
}
