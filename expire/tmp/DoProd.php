<?php
/**
 *
 * @package: expire
 * @version: 0.1
 * @description: 
 * @authors: ing. Antonio Membrides Espinosa
 * @update: 12/03/2013
 * @license: GPL v3
 *
 */
	class DoProd
	{
		public function doit($pivot, $dvr=0)
		{
			echo "freq: ".$dvr->freq."<br>";
			echo "local: ".$dvr->local."<br>";
			echo "pivot: ".$dvr->pivot."<br>";
			echo "current: ".date('Ymd')."<br>";
			echo "path: ".$dvr->path."<br>";
			echo "res: $pivot <br>";
			
		}
	}
