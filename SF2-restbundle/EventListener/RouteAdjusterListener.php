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
 * @description: this class has the responsibility of resolve the real action for REST request execution 
 *
 *		Method		Alternative Controller Action's Names
 * 		GET			getAction 		(id)  	| getAllAction
 * 		PUT			updateAction 	(id) 	| newAction 
 * 		PATCH		modifyAction 	(id) 	| modifyAllAction
 * 		POST		newAction
 * 		DELETE		removeAction 	(id)
 * 		LINK		linkAction 		(id)
 *		UNLINK		unlinkAction 	(id)
 */

namespace XETID\RestBundle\EventListener;

use Symfony\Component\HttpKernel\KernelEvents,
	Symfony\Component\EventDispatcher\EventSubscriberInterface,
	Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpKernel\Event\GetResponseEvent,
	Symfony\Component\HttpKernel\Event\FilterControllerEvent,
	Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent,
	Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Symfony\Component\HttpFoundation\Response;

class RouteAdjusterListener implements EventSubscriberInterface
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function onKernelRequest(GetResponseEvent $event)
	{
		$request = $event->getRequest();
		$this->resolveController($request);
	}

	public function onKernelView(GetResponseForControllerResultEvent $event)
	{
		$value  = $event->getControllerResult();
		$tpl = $event->getRequest()->attributes->get("template");
		if($tpl){
			$response = $this->container->get('templating')->renderResponse($tpl, $value);
		}else{
			$encoder  = $this->resolveEncoders($event->getRequest());
			$encoder  = $this->getEncoders($encoder);
			$response = new Response($encoder->encode($value));
			$response->headers->set('Content-Type', $encoder->contentType);
		}
		$event->setResponse($response);
	}

	public function onKernelController(FilterControllerEvent $event){}
	public function onKernelException(GetResponseForExceptionEvent  $event) {}
	
	public static function getSubscribedEvents()
	{
		return array(
		    KernelEvents::REQUEST => array('onKernelRequest'),
			KernelEvents::CONTROLLER => array('onKernelController'),
			KernelEvents::VIEW => array('onKernelView'),
			KernelEvents::EXCEPTION  => array('onKernelException')
		);
    	}
	
	public function resolveController($request)
	{
		if( strtolower($request->attributes->get('_soamodel')) == "rest" ){
			$access = $request->attributes->get('_route_params[_access]', 0, true );
			$method = $request->getMethod();
			$controller = $request->attributes->get('_controller');
			$controller = str_replace(":controller", ":".$this->resolveAction($access, $method), $controller);
			$request->attributes->set('_controller', $controller);
			$request->attributes->remove('_access');
		}
	}
	
	public function resolveAction($access=0, $method='GET')
	{
		switch($method){
			case 'GET':  	return ($access==="single") ? 'get'    : 'getAll'; break;
			case 'PUT':  	return ($access==="single") ? 'update' : 'updateAll'; break;
			case 'PATCH':  	return ($access==="single") ? 'modify' : 'new'; break;
			case 'POST':  	return 'new'; break;
			case 'DELETE':  return 'remove'; break;
			case 'LINK':  	return 'link' ; break;
			case 'UNLINK':  return 'unlink' ; break;
		}
	}
	
	public function resolveEncoders($request)
	{
		$encoderName = $request->headers->get('Content-Type');
		if(empty($encoderName)) $encoderName = $request->headers->get('accept');
		$format = $request->getFormat($encoderName);
		if(!empty($format)) $encoderName = $format;
		return strtolower($encoderName);
	}

	public function getEncoders($format="extjs")
	{
		if(!$this->container->has("type.$format")) $format="json";
		return $this->container->get("type.$format");
	}
}
