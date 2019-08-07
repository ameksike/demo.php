<?php
         //Se manda a cargar la librería  MapScript
	 if(!extension_loaded("MapScript")) 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);

         //.....Se crea el objeto Mapa 
	 $Map       = ms_newMapObj("src/mapfile.map");
         //.....Se crea el objeto Imagen 
	 $Imagen   = $Map->draw();
         //.....Se manda a guardar para su futura representacion en la Web
	 $URL      = $Imagen->saveWebImage();
 ?>  

<html>
	<head>
 		<TITLE>Mapfile Example</TITLE>
 	</head>

	<body>
		<IMG SRC=<?php echo "".$URL;?>>
	</body>

</html>
