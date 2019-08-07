<?php
/*
 * This file is part of the XETID package for Symfony framework.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @authors: Antonio Membrides Espinosa 
 * @made: 20/05/2013
 * @update: 20/05/2013
 * @description: this class has the responsibility to transform business entitys to Data Transfer Object
 */
namespace XETID\RestBundle\Services;

class DTO
{
	public function transform($entitys){
		$out = array(); 
		if(!is_array($entitys)) $entitys = array($entitys);
		foreach($entitys as $entity)  $out[] = $this->process($entity);
		return $out;
	}

	protected function process($entity){
		$object  = array();
		$methods = get_class_methods($entity);
		foreach($methods as $method){
			if(stripos($method, "get") !== false){
				$value = $entity->{$method}();
				$object[lcfirst(substr($method, 3))] = $this->getValue($value);
			}
		}
		return $object;
	}

	protected function getValue($value){
		return  is_object($value) ? (method_exists($value, 'getId')) ? $value->getId() : 0 : $value;
	}
}
