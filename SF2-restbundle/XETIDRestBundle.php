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
 * @description: this is the interface of RestBundle, responsible for implementing REST services 
 */
 
namespace XETID\RestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
	Symfony\Component\DependencyInjection\ContainerBuilder,
	XETID\RestBundle\DependencyInjection\Compiler\RegisterXETIDRestListeners;

class XETIDRestBundle extends Bundle
{
   public function build(ContainerBuilder $container)
   {
        parent::build($container);
        $container->addCompilerPass(new RegisterXETIDRestListeners());
   }
}
