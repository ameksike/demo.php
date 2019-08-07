<?php
	include "tmp/DoProd.php";
	include "src/ExProd.php";

	//ExProd::this(20130302);
	//ExProd::this(20130302, 'log.txt');
	//ExProd::this(20130302)->supply(new DoProd);
	//ExProd::this()->update(20130302, true); 
	//ExProd::this()->validate();
	
	ExProd::this(20130311)->supply(new DoProd)->run();
?>
