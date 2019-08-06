<?php
/**
 * @author      Antonio Membrides Espinosa
 * @package     simpresion
 * @date        29/06/2015
 * @copyright   Copyright (c) 2015-2015 XETID
 * @license     XETID
 * @version     1.0
 */
class MainController extends ZendExt_Controller_Secure
{
    public function init()
    {
		$this->setIncludePath();
        parent::init();
        $this->traslate = array( 'action' => array(
            'warn' => 'Alvertencia',
            'allow' => 'Permitida',
            'deny' => 'Denegada',
            'cancel' => 'Cancelada'
        ));
    }

    public function mainAction()
    {
        $this->render();
    }

    public function indexAction()
    {
        echo "<pre>";
    }

    public function getAccionesAction()
    {
        $list = array();
        $actions = (new JobhistoryModel())->getActions();
        foreach ($actions as $a) $list[] = array(
            'name' => $this->traslate['action'][strtolower($a['action'])],
            'value' => $a['action']
        );
        echo json_encode($list);
    }

    public function getHistorialAction()
    {
        $model = new JobhistoryModel();
        echo json_encode(array(
            "count"=>$model->getAllCount(array(
                    'where' => json_decode($this->getRequest()->getParam('filters'), true),
                    /*'datein' => $this->getRequest()->getParam('datein'),
                    'dateout' => $this->getRequest()->getParam('dateout')*/
                )),
            "data" => $model->getAll(array(
                    'where' => json_decode($this->getRequest()->getParam('filters'), true),
                    'limit' => $this->getRequest()->getParam('limit'),
                    'offset' => $this->getRequest()->getParam('start'),
                    /*'datein' => $this->getRequest()->getParam('datein'),
                    'dateout' => $this->getRequest()->getParam('dateout')*/
                )),
            "success" => true
        ));
    }

    public function getUsuarioAction()
    {
        $model = new JobhistoryModel();
        echo json_encode(array(
            "count"=>$model->getStatistiCount(array(
                'where' => json_decode($this->getRequest()->getParam('filters'), true),
                /*'datein' => $this->getRequest()->getParam('datein'),
                'dateout' => $this->getRequest()->getParam('dateout')*/
             )),
            "data" => $model->getStatistic(array(
                'where' => json_decode($this->getRequest()->getParam('filters'), true),
                'limit' => $this->getRequest()->getParam('limit'),
                'offset' => $this->getRequest()->getParam('start'),
                /*'datein' => $this->getRequest()->getParam('datein'),
                'dateout' => $this->getRequest()->getParam('dateout')*/
            )),
            "success" => true
        ));
    }

    public function getPrintersAction()
    {
        $model = new JobhistoryModel();
        echo json_encode(array(
            "count"=>$model->getStatistiCount(array(
                    'where' => json_decode($this->getRequest()->getParam('filters'), true),
                    /*'datein' => $this->getRequest()->getParam('datein'),
                    'dateout' => $this->getRequest()->getParam('dateout')*/
            ), 'printers', 'printername', 'printerid'),
            "data" => $model->getStatistic(array(
                    'where' => json_decode($this->getRequest()->getParam('filters'), true),
                    'limit' => $this->getRequest()->getParam('limit'),
                    'offset' => $this->getRequest()->getParam('start'),
                    /*'datein' => $this->getRequest()->getParam('datein'),
                    'dateout' => $this->getRequest()->getParam('dateout')*/
            ), 'printers', 'printername', 'printerid'),
            "success" => true
        ));
    }

    public function getImpresoraAction()
    {
        echo json_encode((new PrintersModel())->getAll());
    }

    protected function getStaticModel($name)
    {
        $path = dirname(__FILE__) . '/../models/static/data/';
        $file = $path . $name . '.json';
        return file_get_contents($file);
    }

    public function getAccionChAction()
    {
        $data = (new JobhistoryModel())->getChartAccion(array(
            'where' => json_decode($this->getRequest()->getParam('filters'), true),
            'limit' => $this->getRequest()->getParam('limit'),
            'offset' => $this->getRequest()->getParam('start'),
            'datein' => $this->getRequest()->getParam('datein'),
            'dateout' => $this->getRequest()->getParam('dateout')
        ));
        foreach($data as $k=>$i)
            $data[$k]['name'] = $this->traslate['action'][strtolower($i['name'])];
        echo json_encode($data);
    }

    public function getCostoAction()
    {
		$data = (new JobhistoryModel())->getChartCosto(array(
            'where' => json_decode($this->getRequest()->getParam('filters'), true),
            'limit' => $this->getRequest()->getParam('limit'),
            'offset' => $this->getRequest()->getParam('start'),
            'datein' => $this->getRequest()->getParam('datein'),
            'dateout' => $this->getRequest()->getParam('dateout')
        ));
		foreach($data as $k=>$i)
            $data[$k]['data1'] = (int)$i['data1'];
        echo json_encode($data);
    }

    public function getImpresionAction()
    {
        echo json_encode((new JobhistoryModel())->getChartImpresion(array(
            'where' => json_decode($this->getRequest()->getParam('filters'), true),
            'limit' => $this->getRequest()->getParam('limit'),
            'offset' => $this->getRequest()->getParam('start'),
            'datein' => $this->getRequest()->getParam('datein'),
            'dateout' => $this->getRequest()->getParam('dateout')
        )));
    }

    public function getSolicitudAction()
    {
        echo json_encode((new JobhistoryModel())->getChartSolicitud(array(
            'where' => json_decode($this->getRequest()->getParam('filters'), true),
            'limit' => $this->getRequest()->getParam('limit'),
            'offset' => $this->getRequest()->getParam('start'),
            'datein' => $this->getRequest()->getParam('datein'),
            'dateout' => $this->getRequest()->getParam('dateout')
        )));
    }

    public function getServidorAction()
    {
        $model = new ServerModel();
        echo json_encode($model->getAll());
        //echo "[]";
    }

    public function saveStatusAction()
    {
        $nodos = json_decode($this->getRequest()->getParam('nodos'), true);
        $model = new ServerModel();
        echo $model->saveStatus($nodos);
    }
    
	protected function setIncludePath(){
        set_include_path(
            get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/../libs'
        );
	}
}
