<?php
function mainGetMap( $opciones = array() )
{
	// Crear un log de registro de rendimiento
	$timeLog	= new timeLog();

	$layerRequest	= request('LAYERS');
	$boxRequest		= request('BBOX');
	$srsRequest		= request('SRS');
	$levelRequest	= request('LEVEL');
	$widthRequest	= request('WIDTH');
	$heightRequest	= request('HEIGHT');
	$formatRequest	= request('FORMAT'); 


	//--- Rutina de seleccion de servidor
	switch ( $layerRequest )
	{
		case "Satellite" : // Satelite
			$host = "khm";
			$versionImagen	= '111';
			$getprefix = '/kh/v='.$versionImagen.'&';
		break;
		case "Satellite-14" : // Satelite
			$host = "khm";
			$versionImagen	= '111';
			$getprefix = '/kh/v='.$versionImagen.'&';
			$opciones['downLoad'] = false;
			$opciones['downLoad'] = false;
		break;
		case "Transparent Labels" :
		case "TransparentLabels" :
			$host = "mt";
			$getprefix = "/vt/lyrs=h@144&hl=en&";
			break;
		case "Streets" : // Callejero
			$host = "mt";
			$getprefix = "/vt/hl=en&";
		break;
	}

 

	//Tomar el cuadro en srid 900913, 3857 or 3785.
	$coordinateatoms = explode (',', $boxRequest);

	// si se pide de una proyeccion EPSG:4326 hacer el cambio a la 900913
	// porque para convertir devollevarlo a metros del ecuador y grendwich
	// porque es la unica forma que se de convertir una escala y saber cuantos tiles deservidor me hacen falta
	$srs			 = $srsRequest;
	switch ( $srs)
	{
		case 'EPSG:4326':
			// Conversion del punto de inicio minimo y final maximo
			$init			= convertir_wgs84_900913($coordinateatoms[0],$coordinateatoms[1]);
			$end			= convertir_wgs84_900913($coordinateatoms[2],$coordinateatoms[3]);
			// lo modifico y lo dejo como si fuera la caja en 900913
			$coordinateatoms = array_merge($init,$end);
			break;
	}

	// ancho en metros que debe buscarse
	$meterwidth 	= $coordinateatoms[2] - $coordinateatoms[0];

	// Buscando los pixel que se van a dibujar en la peticon tanto de altura como ancho
	$pixelwidth 		= $widthRequest;
	if ($pixelwidth <=0)
	$pixelwidth 	= 1;
	$pixelheight 		= $heightRequest;
	if ($pixelheight <=0)
	$pixelheight 	= 1;

	// verificar cuando no se pide ningun espacio almenos dibujar para un metros
	if ($meterwidth <= 0 )
	$meterwidth 	= 1;

	// buscar la proporcion de las imagenes segun la caja, el tamano que debe tener la imagen y la dimencion real que son 256
	$metersperimage 	= $meterwidth / $pixelwidth * 256;
	//Reorientar los minimos y maximos un cuado exacto.
	$googlemeterminx 	= $coordinateatoms[0] + googlemaxmapmeters;
	$googlemeterminy 	= googlemaxmapmeters - $coordinateatoms[3];
	$googlemetermaxx 	= $coordinateatoms[2] + googlemaxmapmeters;
	$googlemetermaxy	= googlemaxmapmeters - $coordinateatoms[1];

	$googleMminx 	= $coordinateatoms[0];
	$googleMminy 	= $coordinateatoms[1];
	$googleMmaxx 	= $coordinateatoms[2];
	$googleMmaxy	= $coordinateatoms[3];


	// eliminar la posibilidad de dividir entre 0
	if($metersperimage == 0)
	$metersperimage = 1;

	$zoomfactor = $levelRequest;
	// si no se pide un zoom especifico
	if ( ! $levelRequest ) {
		
		//redondear para que quede con menos perdida la imagen a lo mas cercano a un entero
		$zoomfactor 		= round(log(googlemaxmapmeters * 2 / $metersperimage, 2));
	
		//Tomar el maximo facor de nivel que debe ser de 0-22.
		if ($zoomfactor > googlemaxzoomfactor)
		$zoomfactor 	= googlemaxzoomfactor;
		if ($zoomfactor < 0)
		$zoomfactor 	= 0;
	}
	// calcular el tamano necesario para en metros para dar la respuesta
	$mapmeterspertile 	= googlemaxmapmeters * 2 / (1 << $zoomfactor);
	// definir segun este tamano los bordes que debe tener la imagen
	$tileminx 			= floor($googlemeterminx / $mapmeterspertile);
	$tileminy 			= floor($googlemeterminy / $mapmeterspertile);
	$tilemaxx 			= floor($googlemetermaxx / $mapmeterspertile);
	$tilemaxy 			= floor($googlemetermaxy / $mapmeterspertile);
 

	// crear la imagen con el tamano total de la union de todas las que voy a pedir
	// (esta la utilizo para picarla)
	// Esto es como crear un lienzo en blancopara escribir los tiles de google
	$tileim 			= null;
	if ( $opciones['render'] ) {
		$tileim 			= imagecreatetruecolor (256 * ($tilemaxx - $tileminx + 1), 256 * ($tilemaxy - $tileminy + 1));
		//$transparentcolor 	= imagecolorallocatealpha($tileim, 0, 0, 0, 127);
		//imagefill($tileim, 0, 0, $transparentcolor);
 
	}
	 

	$urlImagenes 		= array();
	$urlImagenesParams 	= array();

	$servernumber = 0;
	//conformar la peticion para cada una de las imagenes que pueden crear la deseada.
	for ($y = $tileminy; $y <= $tilemaxy; $y++)
		if ($y >= 0 && $y < (1 << $zoomfactor)) // verificar que no busquen mas imagenes que el maximo que soporta el factor de zoom
			for ($x = $tileminx; $x <= $tilemaxx; $x++)
				if ($x >= 0 && $x < (1 << $zoomfactor)) { // verificar que no busquen mas imagenes que el maximo que soporta el factor de zoom
			
					// $urlImagenes[] = "http://".$host.$servernumber.".google.com".$getprefix."x=".$x."&y=".$y."&z=".$zoomfactor."&s=".substr("Galileo", 0, (($x * 3) + $y) % 8);
					$urlImagenes[] = array('host'=>$host,'numeroservidor'=>$servernumber,'dominio'=>".google.com",'prefijo'=>$getprefix,'prefijoM'=>str_replace('/','_',$getprefix),'x'=>$x,"y"=>$y,"z"=>$zoomfactor,"s"=>substr("Galileo", 0, (($x * 3) + $y) % 8));
			
			
					// configuracion de la dispocion del tile que voy a pedir
					if (  $opciones['render']  )
						$urlImagenesParams[]= array ($tileim, NULL ,($x - $tileminx) * 256, ($y - $tileminy) * 256, 0, 0, 256, 256, 256, 256);
			
					// pedir siempre a uno de los 4 servidores que conzco de google
					$servernumber++;
					if( $servernumber >3 ) // son solo 4 servidores
					$servernumber =0;
				}




	 	$timeLog->registrar('Tiempo que demoró en la obtencion de las imagenes (desde google o de la cache si ya esta en ella)');

		// rutina para pedir de forma paralela	(uso curl con multiples hilos para hacerlo mas rapidos y la rutina de cache se la dejo a esta funcion)
		$ResultImagenes = getgooglemaptile( $urlImagenes, $opciones['render'], $opciones['downLoad'] , &$timeLog  );
		unset($urlImagenes);
		$urlImagenes	= $ResultImagenes;
		$timeLog->registrar('Tiempo que demoró en la obtencion de las imagenes (desde google o de la cache si ya esta en ella)');


		if (  $opciones['render']  ) {


			// Rutina para trasformar a la proyeccion deseada y crear una cache de esta a las imagenes que se cargaron
			//$ResultImagenes = getgooglemaptileWGS84( $ResultImagenes );

			$contador		= 0;

			foreach ($ResultImagenes as $urlImage => $ImagenCurl) {

				// crear la imagen que se obtuvo
				$gm 		= @imagecreatefromstring($ImagenCurl['content']) or imagecreatefromstring(GenerarLogError( $urlImagenesParams[$contador] ))  ;
				$params	= $urlImagenesParams[$contador++];
				// copiarla al lienzo en blanco ->$tileim
				if ($gm != null)
				imagecopyresampled( $params[0], $gm, $params[2], $params[3], 0, 0, 256, 256, 256, 256);

			}

			// Creo la imagen que se va a devolver con el tamano que se pidio
			$im = imagecreatetruecolor ($pixelwidth, $pixelheight);

			//tomar las dimenciones de las 4 imagenes y corregirlas a lo que se pide  en el lienzo de devolucion.
			$pixeltrimminx = round(($googlemeterminx / $mapmeterspertile - $tileminx) * 256);
			$pixeltrimminy = round(($googlemeterminy / $mapmeterspertile - $tileminy) * 256);
			$pixeltrimmaxx = round(($tilemaxx + 1 - $googlemetermaxx / $mapmeterspertile) * 256);
			$pixeltrimmaxy = round(($tilemaxy + 1 - $googlemetermaxy / $mapmeterspertile) * 256);

			//( Solo para la capa )Habilitar transparencia alfa.
			if ( $layerRequest == "Transparent Labels" && $formatRequest == "image/png")
			 {
				imagesavealpha($im, true);
				$transparentcolor = imagecolorallocatealpha($im, 0, 0, 0, 127);
				imagefill($im, 0, 0, $transparentcolor);
			}

			//Corregir las dimenciones de los pixel.
			$sourcepixelwidth = imagesx($tileim) - $pixeltrimmaxx - $pixeltrimminx;
			if ($sourcepixelwidth <= 0) 
				$sourcepixelwidth = 1;
				
			$sourcepixelheight = imagesy($tileim) - $pixeltrimmaxy - $pixeltrimminy;
			if ($sourcepixelheight <= 0) 
				$sourcepixelheight = 1;

			//Copiar de la imagen total la parte ue me intereza al lienzo de devolucion.
			imagecopyresampled ($im, $tileim, 0, 0, $pixeltrimminx, $pixeltrimminy, imagesx($im), imagesy($im), $sourcepixelwidth, $sourcepixelheight);


			$tmpFile		= dir_tmp.microtime(true).rand();
			$tmpFilePNG		= $tmpFile.'.png';
			$tmpFileResult	= $tmpFile.'RESULT.tiff';
			
			if( $zoomfactor > 11)
			{ 
				header('Content-Type: '.$formatRequest);
				imagejpeg($im );
				imagedestroy($im);die;
						
					// Rutina de trasformacion de la proyeccion
				switch ( $formatRequest )
				{
					case 'image/jpeg' :
						imagejpeg($im );
						break;
					case 'image/gif' :
						imagegif($im );
						break;
					case 'image/png' :
					default:
						imagepng($im );
				}
				imagedestroy($im);
			}
			else
			{
				/**/
				// Rutina de trasformacion de la proyeccion
				
				switch ( $formatRequest )
				{
					case 'image/jpeg' :
						imagejpeg($im,$tmpFilePNG);
						break;
					case 'image/gif' :
						imagegif($im,$tmpFilePNG);
						break;
					case 'image/png' :
					default:
						imagepng($im,$tmpFilePNG);
				}
				imagedestroy($im);
	/*	
				
			//	echo file_get_contents($tmpFilePNG);
	die();*/

				// Registrar el tiempo que se demoro la ultima operacion
				$timeLog->registrar('Tiempo que demoró ajustando y creando la imagen a devolver ');

				TransformarConFichero( $pixelwidth,$pixelheight, $coordinateatoms, $tmpFile );
				// Registrar el tiempo que se demoro la ultima operacion
				$timeLog->registrar('Tiempo  que demoró georeferenciando y reproyectando ');

 
				header('Content-Type: '.$formatRequest);
				$image = new Imagick($tmpFileResult);
				$image->setImageFormat('png');
				// Registrar el tiempo que se demoro la ultima operacion
				$timeLog->registrar('Tiempo  que demoró  trasnformando de GTiff a png ');

				echo $image;
				unlink($tmpFileResult);

				// Registrar el tiempo que se demoro la ultima operacion
				$timeLog->registrar('Tiempo  que demoró  enviando al cliente la png ');
				// salvando el registro de tiempos en un fichero
				$timeLog->salvarregistro();	
					
			}

		}
	 
	// si se pidio devolver las URL
	if ( $opciones['getUrl'] )
	{
		return $urlImagenes;
	}
}
?>
