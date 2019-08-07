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
namespace XETID\RestBundle\Services\Encoders;

class TypeJSON extends Type
{
	public function __construct(){ $this->contentType = 'aplication/json'; }
	public function encode($data){ return json_encode($data); }
	public function decode($data){ return json_decode($data, true); }
}
