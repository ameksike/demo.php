<?php
/*
 * @author		Antonio Membrides Espinosa
 * @package    	simpresion
 * @date		10/08/2015
 * @copyright  	Copyright (c) 2015-2015 XETID
 * @license    	XETID
 * @version    	1.0
 */
namespace Xetid\AlertBundle\Entity;
use Doctrine\ORM\EntityRepository;
class AlertRepository extends EntityRepository
{
	protected function getDTO($list){
		$dto = array();
		$list = is_array($list) ? $list : array($list);
		foreach($list as $entity){
			$dto[] = array(
				'id'=> $entity->getId(),
				
				'objetive'=> $entity->getObjetive(),
				'criteria'=> $entity->getCriteria(),
				'den'=> $entity->getDen(),
				
				'type'=> $entity->getType(),
				'action'=> $entity->getAction(),
				'printer'=> $entity->getPrinter()
			);
		}
		return $dto;
	}
	
	protected function apply($entity, $dto){
		if(isset($dto['objetive'])) $entity->setObjetive($dto['objetive']);
		if(isset($dto['criteria'])) $entity->setCriteria($dto['criteria']);
		if(isset($dto['den'])) 		$entity->setDen($dto['den']);
		if(isset($dto['type'])) 	$entity->setType($dto['type']);
		if(isset($dto['action']))	$entity->setAction($dto['action']);
		if(isset($dto['printer']))	$entity->setPrinter($dto['printer']);
		return $entity;
	}
	
	protected function persist($list, $action='persist'){
		$list = is_array($list) ? $list : array($list);
		$em = $this->getEntityManager();
		foreach($list as $i)
			$em->{$action}($i);
		$em->flush();	
	}
	
	public function add($dto){
		$entiy = new Alert();
		$this->persist($this->apply($entiy, $dto));
		return $this->getDTO($entiy);
	}
	
	public function edit($dto){
		$entiy = $this->find($dto['id']);
		if($entiy ) $this->persist($this->apply($entiy, $dto));
		return $this->getDTO($entiy);
	}
	
	public function dell($dto){
		$entiy = $this->find($dto['id']);
		if($entiy ) $this->persist($entiy, 'remove');
		return $this->getDTO($entiy);
	}
	
	public function query4get($dto){
		$qb = $this->createQueryBuilder('a');
		foreach($dto as $k=>$i){
			if(!empty($i)){
				$qb = $qb
					->andWhere("a.$k LIKE :$k")
					->setParameter($k, "%$i%")
				; 
			}
		}
		return $qb;
	}
	
	public function get($dto=array(), $limit=false, $offset=false){
		$qb = $this->query4get($dto);
		if ($limit)  $qb->setMaxResults($limit);
		if ($offset) $qb->setFirstResult( $offset );
		return $qb->getQuery()->getArrayResult();
	}
	
	public function total($dto){
		$qb = $this->query4get($dto)->select('COUNT (a.id) as total');
		return $qb->getQuery()->getSingleScalarResult();
	}
}
