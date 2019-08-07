<?php

/*
 * This file is part of the XETID package for Symfony framework.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author: Antonio Membrides Espinosa 
 * @made: 14/05/2013
 * @update: 16/06/2013
 * @description: this is the controller running by default in case not specified route's configurations
 */

namespace XETID\RestBundle\Controller;

class DoctrineController extends DefaultController
{
	protected function getMetadata($entity=0){
		$entity = $entity ? is_object($entity) ? get_class($entity) : $entity : $this->resource->repository;
		return $this->getDoctrine()->getManager()->getMetadataFactory()->getMetadataFor($entity);
	}

	protected function createQuery(){
		$query = $this->getDoctrine()->getManager()->createQueryBuilder();
		$resource = $this->resource;
		$parent = $this->resource->parent;
		
		$query->select($resource->alia);
		$query->from($resource->repository, $resource->alia);
		if($resource->id){
			$rmtd = $this->getMetadata($resource->repository); 
			$id = $rmtd->identifier[0];

			$query->andwhere($resource->alia.".$id = :".$resource->alia."Id");
			$query->setParameter($resource->alia."Id", $resource->id);
		}

		while ($parent){
			$association = (isset($this->getMetadata($resource->repository)->associationMappings[$parent->camel]))
			? $parent->camel : $parent->camel."s";

			$rmtd = $this->getMetadata($parent->repository);
			$id = $rmtd->identifier[0];

			$query->leftJoin($resource->alia.".".$association, $parent->alia);
			$query->andwhere($parent->alia.".$id = :".$parent->alia."Id");
			$query->setParameter($parent->alia."Id", $parent->id);
			
			$resource = $parent;
			$parent = $resource->parent;
		}
		$query = $this->onCreateQuery($query);
		return $query->getQuery();
	}

	protected function onCreateQuery($queryBuilder){ return $queryBuilder; }

	protected function setter($obj, $data){
		$mtd = $this->getMetadata($obj); // optimizar ... memoria/procesador
		foreach($data as $property=>$value) {
			$action = "set".ucfirst($property);
			if(method_exists ($obj, $action)){
				if(isset($mtd->associationMappings[$property])){
					$entity = $mtd->associationMappings[$property]['targetEntity'];
					$em=$this->getDoctrine()->getManager();
					$o = $em->find($entity, $value);
					$value = $o;
					$obj->{$action}($value);					
				}
				$obj->{$action}($value);
			}
		}
	}

	//... Actions ...
	public function getAction($id=0){
		$resource = $this->createQuery()->getResult();
		return $this->get('dto')->transform($resource);
	}
	
	public function getAllAction(){
		$resource = $this->createQuery()->getResult();
		return $this->get('dto')->transform($resource);
	}	
	
	public function removeAction($id=0){
		$resource = $this->createQuery()->getResult();
		foreach($resource as $i) 
			$this->getDoctrine()->getManager()->remove($i);
		$this->getDoctrine()->getManager()->flush();
	}
	
	public function updateAction($id=0){
		$resource = $this->createQuery()->getResult();
		$data = $this->getPUT();
		foreach($resource as $i) {
			if(is_array($data)) $this->setter($i, $data);
			$this->getDoctrine()->getManager()->persist($i);
		}
		$this->getDoctrine()->getManager()->flush();
	}

	public function newAction()	{		
		$Entity = $this->resource->entity;
		$resource = new $Entity();
		
		$data = $this->get('request')->request->all();
		if(is_array($data)) $this->setter($resource, $data);
		$data = $this->getPUT();
		if(is_array($data)) $this->setter($resource, $data);

		$this->getDoctrine()->getManager()->persist($resource);
		$this->getDoctrine()->getManager()->flush();
	}
}
