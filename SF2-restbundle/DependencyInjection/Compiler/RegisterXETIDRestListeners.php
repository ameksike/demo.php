<?php

/*
 * This file is part of the XETID package for Symfony framework.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author: Antonio Membrides Espinosa 
 * @made: 10/05/2013
 * @update: 11/05/2013
 * @description: this class has the responsibility of register listeners
 */

namespace XETID\RestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RegisterXETIDRestListeners implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('event_dispatcher')) {
            return;
        }

        $definition = $container->getDefinition('event_dispatcher');
		
		$definition->addMethodCall('addSubscriberService', array(
			'xetid_rest_routeadjuster_listener', 'XETID\RestBundle\EventListener\RouteAdjusterListener'
		));
		
		$definition->addMethodCall('addSubscriberService', array(
			'xetid_rest_routeadbuilder_listener', 'XETID\RestBundle\EventListener\RouteBuilderListener'
		));
    }
}
