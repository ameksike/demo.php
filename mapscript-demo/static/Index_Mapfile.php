<?php
         //Se manda a cargar la librería  MapScript
	 if(!extension_loaded("MapScript")) 
		dl('php_mapscript.'.PHP_SHLIB_SUFFIX);

         //.....Se crea el objeto Mapa 
	 $Map       = ms_newMapObj("mapfile.map");
         //.....Se crea el objeto Imagen 
	 $Imagen   = $Map->draw();
         //.....Se manda a guardar para su futura representacion en la Web
	 $URL      = $Imagen->saveWebImage();
 ?>  

<html>
	<head>
 		<TITLE>Equipo #1</TITLE>
 	</head>

	<body>
		<h1>Equipo #1</h1>
		<IMG SRC=<?php echo "".$URL;?>>
	</body>

</html>
