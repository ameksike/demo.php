<?php

	if(defined('STDIN') ){
		$br = "\n";
		$ar = isset($argv[1]) ? $argv[1] : 0;
	} 
	else{
		$br = "<br>";
		$ar = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : 0;
	}  

	$ar = explode('/', $ar);
	
	print_r($ar);
	echo $br;
	
	
	
?>
