<?php
use Ksike\ksl\filter\iface\Error;
class MyExeption implements Error
{
	public static function onCatch($error){
		if($error["mode"]=="exception"){
			echo "<br> exept: "; 
			print_r($error);
		}
	
	}
}
