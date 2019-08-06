<?php
/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		05/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
namespace Xetid\ReportBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
	public function printerHistoryAction(){
		$data = $this->formatDataStruct('getJobHistory');
		return $this->render('XetidReportBundle:Default:historial.html.twig', $data); 
	}
	public function printerHistoryPDFAction(){
		$exporter = $this->get('xetid_report.exporter.pdf');
		$view = $this->printerHistoryAction(); 
		return $exporter->export($view, 'Historial de Impresiones');
	}
	
	public function printerListAction(){
		$data = $this->formatDataStruct('getPrinterList');
		return $this->render('XetidReportBundle:Default:printer.html.twig', $data); 
	}
	public function printerListPDFAction(){
		$exporter = $this->get('xetid_report.exporter.pdf');
		$view = $this->printerListAction(); 
		return $exporter->export($view, 'Historial de Impresiones');
	}
	
	public function userListAction(){
		$data = $this->formatDataStruct('getUserList');
		return $this->render('XetidReportBundle:Default:users.html.twig', $data); 
	}
	public function userListPDFAction(){
		$exporter = $this->get('xetid_report.exporter.pdf');
		$view = $this->userListAction(); 
		return $exporter->export($view, 'Historial de Impresiones');
	}
    
	protected function formatDataStruct($action){
		return array(
			'date'=> date('d/m/Y'),
			'server'=> $this->get('xetid_report.printer_server')->loadServerConfig(),
			'list'=> $this->get('xetid_report.printer_server')->{$action}()
		);
	}
}
