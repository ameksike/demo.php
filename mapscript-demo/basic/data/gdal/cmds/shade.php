<?php

	if(defined('STDIN') ){
		$br = "\n";
		echo("Running from CLI ".$br);
	} 
	else{
		$br = "<br>";
		echo("Not Running from CLI ".$br); 
	}  

	//empty($_SERVER['SHELL']) && die('shells only please');
	
	if(isset($argv)) print_r($argv);
	else print_r ($_SERVER['PATH_INFO']);

	print $br."memory_limit=".ini_get("memory_limit").$br;
	print "safe_mode=".ini_get("safe_mode").$br;

	
?>
