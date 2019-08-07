<?php

 

function obtenerDireccionImagenEnCache($datos, $src = false) 
{
	$ficheroCache	= dir_cache_google;

	// confomar la direccion donde se debe guardar la cache
	if ( !file_exists(  $ficheroCache  ) ) {
		mkdir( $ficheroCache );
	}

	// cuando se especifica una cache de un src 
	if ( $src ) {
		// crear la carpeta para el servidor si esta no existe
		$ficheroCache.= $src.'/';
		// confomar la direccion donde se debe guardar la cache
		if ( !file_exists(  $ficheroCache  ) ) {
			mkdir( $ficheroCache );
		}
	} 
	// crear la carpeta para el servidor si esta no existe
	$ficheroCache.= $datos['host'].'/';
	if ( !file_exists(  $ficheroCache  ) ) {
		mkdir( $ficheroCache );
	}
	// crear la carpeta para el prefijo del servidor
	$ficheroCache.=  $datos['prefijoM'].'/';
	if ( !file_exists(  $ficheroCache  ) ) {
		mkdir( $ficheroCache );
	}
	
	// crear la carpeta para cada uno de los niveles de zoom
	$ficheroCache.= $datos['z'].'/';
	if ( !file_exists(  $ficheroCache  ) ) {
		mkdir( $ficheroCache );
	}
	
	// verificar si la imagen a buscar existe
	$ficheroCache.= $datos['x'].'-'.$datos['y'];
	return $ficheroCache;
}
/**
 * Funcion que devuelve la imagen por defecto a utilizar
 *
 * @return string
 */
function cargarImagenDefecto()
{
	return file_get_contents(dir_cache_google.'/default.png');
}

/**
 * Funcion que devuelve la imagen por defecto a utilizar
 *
 * @return string
 */
function cargarImagenDefecto404( $texto = false )
{
	
	if(strpos($texto,'404' ) !== false)
	{ 
		$defecto = cargarImagenDefecto404();
		return file_get_contents(dir_cache_google.'/default_404.png');
	}
	return false;
	
}

function GenerarLogError( $datos )
{
	$manejador = fopen('errores.log','a');
	fwrite ( $manejador, serialize( $datos ) );
	fclose ( $manejador );
	return cargarImagenDefecto();
}

/**
 * Verificar si la peticion esta en cache y retornarla en caso de que este
 *
 * @param array $datos
 * @return string
 */
function cargarCACHE( $datos ,  $download)
{
	 
	// verificar si la imagen a buscar existe
	$ficheroCache = obtenerDireccionImagenEnCache( $datos );
	$resultDefault= array('content'=>'','cache'=>false,'datos'=>'');
	
	
	// si no existe o el tamano es muy pequeno
	if ( !file_exists(  $ficheroCache  )   ) {
		// si no existe devolver vacio
		return $resultDefault;
	}
	else 
	{
		$size = filesize($ficheroCache); 
		if(  $download && $size < 400 )
			return $resultDefault;
			
		// cargar el contenido del fichero
		$contenido = file_get_contents($ficheroCache);
		if ($contenido == '') {
			return $resultDefault;
		}
		else {
			 
			// si no es una imagen
			if ( strpos( mime_content_type($ficheroCache) , 'image' ) !== false  ) 
			{
				
				return  array('content'=>$contenido,'cache'=>$ficheroCache,'datos'=>$datos);
			}
			
			return $resultDefault;
			 
		}
	}
}


/**
 * Escribe la imagen en la cache y verifica que sea una imagen correcta si no devuelve falso
 *
 * @param array $datos
 * @param string $stringImagen
 */
function salvarCACHE( $datos , $stringImagen)
{
	 
	// verificar si la imagen a buscar existe
	$ficheroCache = obtenerDireccionImagenEnCache( $datos );
	
	file_put_contents($ficheroCache,$stringImagen); 
  
	// si no es imagen lo que sesalvo
	if(strpos( mime_content_type($ficheroCache) , 'image' ) === false )
	{
	
		unlink($ficheroCache);//die($stringImagen);
		file_put_contents('./Errores/Error.txt',$stringImagen); 
		 return false; 
	}
	return $ficheroCache;
}

?>
