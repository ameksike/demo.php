<?php

/*
 * This file is part of the XETID package for Symfony framework.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @authors: Antonio Membrides Espinosa 
 * @made: 10/05/2013
 * @update: 16/05/2013
 * @description: this class has the responsibility of creating fictitious routes for REST services 
 */

namespace XETID\RestBundle\EventListener;

use Symfony\Component\HttpKernel\KernelEvents,
	Symfony\Component\HttpKernel\Event\GetResponseEvent,
	Symfony\Component\EventDispatcher\EventSubscriberInterface,
	Symfony\Component\DependencyInjection\ContainerInterface;

class RouteBuilderListener implements EventSubscriberInterface
{

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
	
    public function onKernelRequest(GetResponseEvent $event){
		$this->resolveRoutes($this->container->get('router')->getRouteCollection());
	}

    public static function getSubscribedEvents(){
        return array(
			KernelEvents::REQUEST => array(array('onKernelRequest', 100))
        );
    }
	
	public function resolveRoutes($routes){
		foreach($routes->all() as $k=>$i){
			if(strtolower($i->getDefault('_soamodel')) == "rest") {
				$i->setPattern($this->resolvePattern($i, $routes));
				$i->setDefault('_controller', $this->resolveController($i));
				$i->setDefault('_soamodel', 'REST');
				$i->setDefault('_root', $i->getDefault('_parent'));
				$i->setDefault('_parent', '');
				$new = clone $i;
				$new->setDefault('_access', 'single');
				$new->setPattern($this->resolvePattern($i, $routes, true));
				$routes->add($k.'_id', $new);
			}
		}
	}
	
	public function resolvePattern($i, $routes, $id=false){
		if($i){
			$key = $id ? "/{".lcfirst($this->resolveResource($i))."Id}" : "";
			$parent = !$i->getDefault('_parent') ? "" : 		
					  $this->resolvePattern($routes->get($i->getDefault('_parent')), $routes, true);
			return $parent.$i->getPattern().$key;
		}
	}

	public function resolveController($i){
			if(!$i->getDefault('_controller')) return  'XETIDRestBundle:Doctrine:controller';
			else {
				$controller = $i->getDefault('_controller');
				$controller = explode(":", $controller);
				switch(count($controller))
				{
					case 1 :
						$controller = $controller[0];
						return "XETIDRestBundle:$controller:controller";
					break;		
			
					case 2 :
						$bundle = $controller[0];
						$controller = $controller[1];
						return "$bundle:$controller:controller";
					break;

					default : return $i->getDefault('_controller'); break;
				}
			}
	}

	public function resolveResource($i){
		if($i){
			$resource = explode(":", $i->getDefault('_resource'));
			return $resource[count($resource)-1];
		}
	}
}
