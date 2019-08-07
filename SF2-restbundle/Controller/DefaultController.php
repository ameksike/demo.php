<?php

/*
 * This file is part of the XETID package for Symfony framework.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author: Antonio Membrides Espinosa 
 * @made: 14/05/2013
 * @update: 16/05/2013
 * @description: this is the controller running by default in case not specified route's configurations
 */

namespace XETID\RestBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	protected $resourceObj = false;

	public function controllerAction(){}
	public function getAction($id=0){}	
	public function getAllAction(){}	
	public function newAction()	{}
	public function modifyAction($id=0){}
	public function updateAction($id=0){}
	public function removeAction($id=0){}
	public function linkAction($id=0){}
	public function unlinkAction($id=0){}
	public function deleteAction($id=0){}

	public function getPUT(){
		$data  = stripslashes(file_get_contents('php://input'));
		$imput = json_decode($data, true);
		return is_array($imput) ? $imput : $data;
	}

	public function getResource(){
		return $this->get('rest.resource');
        print_r( '');

	}
	
	public function getId($resource=0){
		$request = $this->get('request');
		$nameid = !$resource ? $request->attributes->get("_resource") : $resource;
		return $request->attributes->get($nameid."id");
	}

	public function __get($key){
			switch($key){
				case 'resource': return $this->getResource(); break;
			}
	}
}
