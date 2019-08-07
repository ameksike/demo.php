<?php
	include "src/MS_Admin.php";
	$MS_Adm = new MS_Admin();
	$Map    = $MS_Adm->makeMap();
	$Imagen = $Map->draw();
	$URL    = $Imagen->saveWebImage();
?>

<html>
	<head>
 		<TITLE>Mapscript Example</TITLE>
 	</head>

	<body>
		<IMG SRC=<?php echo "./".$URL;?>>
	</body>
</html>
