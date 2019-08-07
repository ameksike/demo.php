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
 * @description: this class has the responsibility to manipulate the properties of a resource 
 */
namespace XETID\RestBundle\Services;
use	Symfony\Component\DependencyInjection\ContainerInterface;

class Resource {
	
	protected $container;
	protected $_bundle;
	protected $_name;
	protected $_parent;

	public function __construct(ContainerInterface $container, $routeid=false){
		$this->container  = $container;
		$this->routeid = $routeid;

		$this->_bundle=0;
		$this->_name=0;
		$this->_parent=-1;
	}

	public function __get($key){
		switch($key){
			case 'name': return $this->getName(); break;
			case 'bundle': return $this->getBundle(); break;
			case 'id': return $this->getId(); break;

			case 'idname': return $this->getIdName(); break;
			case 'parent': return $this->getParent(); break;
			case 'repository': return $this->getRepository(); break;
			case 'entity': return $this->getEntity(); break;

			case 'alia': return strtolower($this->getName()); break;
			case 'pascal': return ucwords($this->getName()); break;
			case 'camel': return lcfirst($this->getName()); break;
		}
	}

	public function getBundle(){
		return !$this->_bundle ? $this->resolveResource('_bundle') : $this->_bundle;
	}

	public function getName(){
		return !$this->_name ? $this->resolveResource() : $this->_name;
	}

	public function getId(){
		return $this->container->get('request')->attributes->get($this->getIdName());
	}

	public function getIdName(){
		return lcfirst($this->getName())."Id";
	}

	public function getParent(){
		if($this->_parent === -1){
			$parent = $this->get('_root');
			$this->_parent = $parent ? new self($this->container, $parent) : false;
		}return $this->_parent;
	}

	protected function getRepository(){
		return $this->get('_resource');
	}

	public function getNameSpace ($bundle){
		$list = $this->container->getParameterBag()->get('kernel.bundles');
		return $list[$bundle];
	} 

	protected function getEntity($path="Entity\\"){
		$namespace = str_ireplace($this->bundle,"", $this->getNameSpace($this->bundle));
		return $namespace.$path.$this->name;
	}

	protected function resolveResource($key="_name"){
		$resource = $this->get('_resource');
		$resource = explode(':', $resource);
		$this->_name = $resource[1];
		$this->_bundle = $resource[0];
		return $this->{$key};
	}

	protected function get($key="name"){
		return (!$this->routeid) ? $this->container->get('request')->attributes->get($key)
							 : $this->container->get('router')->getRouteCollection()->get($this->routeid)->getDefault($key);
	}
}
