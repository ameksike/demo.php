<?php



/** 
 * FUNCION PARA PEDIR POR LA URL LA IMAGEN A GOOGLE.
 * 
 * @param $urlImagenes array()
 */
function  getgooglemaptile ( $urlImagenes, $render = true, $download = true, $timeLog ) { 
	// verifica si hay conexion con google
	$download = true;//verificarConexion();
	
	
	if( !$render && !$download)
		return getgooglemapDownload ( $urlImagenes, $render  , $download  );
		
	$inicio = 1;
	$offset =  CONFIG_rate;
	
	$cantidad = count ($urlImagenes);
	 
	$arregloRetorno = array();
	do
	{ 
		$arreglo_result = array_slice($urlImagenes,$inicio-1,$offset,true) ;
		
		$arreglo_result = getgooglemapDownload ( $arreglo_result, $render  , $download ,  &$timeLog );
		$arregloRetorno = array_merge($arregloRetorno,$arreglo_result); 
		$inicio+=$offset;
		
	}
	while ( $cantidad >= $inicio ); 
	 
	return $arregloRetorno;
}


/** 
 * FUNCION PARA PEDIR POR LA URL LA IMAGEN A GOOGLE.
 * 
 * @param $urlImagenes array()
 */
function  getgooglemapDownload ( $urlImagenes, $render = true, $download = true, $timeLog) { 
	
	// cargar variables de configuracion para trabajo con proxys
	$proxy		= CONFIG_proxy; 
	$usuario	= CONFIG_usuario;
	$passw		= CONFIG_passw;
	  
	$res = array();
	$sesionesGoogle = file('sesiones.txt');
	$cantidadSessiones	= count($sesionesGoogle);
    $contadorSessiones = 0;	
	$mh = curl_multi_init();
	$curl_array = array();
	foreach($urlImagenes as $i => $datos)
	{
		// conformar la url a pedir
		$url 	 	= gererarURL($datos);
		
		// obtener la cache de la direccion si esta existe
		$res[$url]	= cargarCACHE( $datos, $download);
		
		
		// echo (obtenerDireccionImagenEnCache($datos));
		if(  isset($download) && $download  && !$res[$url]['content']  )
		{  

			$curl_array[$i] = curl_init($url);
			//echo $url.'<br>';
			if($proxy)
			{
				curl_setopt($curl_array[$i], CURLOPT_PROXY, $proxy);
				curl_setopt($curl_array[$i], CURLOPT_PROXYUSERPWD, $usuario.':'.$passw); 
			}
			$hostHeader	= "http://".$datos['host'].$datos['numeroservidor'].$datos['dominio'];
			
			curl_setopt($curl_array[$i],CURLOPT_CONNECTTIMEOUT,15);
			curl_setopt($curl_array[$i], CURLOPT_FAILONERROR, 1);
			//curl_setopt($curl_array[$i], CURLOPT_REFERER, 'http://10.12.170.159/GIS/Investigacion/dev/OpenLayers/examples/google.html');
			curl_setopt($curl_array[$i], CURLOPT_USERAGENT, '	Mozilla/5.0 (X11; Linux x86_64; rv:8.0) Gecko/20100101 Firefox/8.0 Iceweasel/8.0');
			curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_array[$i], CURLOPT_COOKIE,$sesionesGoogle[$contadorSessiones++]);
			if( $contadorSessiones >= $cantidadSessiones )
				$contadorSessiones  = 0;
 			curl_setopt($curl_array[$i], CURLOPT_ENCODING,'gzip, deflate');
			curl_setopt($curl_array[$i], CURLOPT_HTTPHEADER,array("Proxy-Connection: keep-alive",
																"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
																"Accept-Language: es-es,es;q=0.8,en-us;q=0.5,en;q=0.3",
																"Accept: image/png,image/*;q=0.8,*/*;q=0.5" ));
			curl_multi_add_handle($mh, $curl_array[$i]);
	    }
	    else 
	    {
	    	if (!$render ) {
	    		$res[$url]['content']	= '';
	    	}
	    }
	    $timeLog->registrar('Tiempo que demoró en la obtencion de las imagen '.$url);
	}
	
	$running = NULL;
	do {
	    //usleep(10000);
	    usleep(CONFIG_microsecond_request_time);
	    curl_multi_exec($mh,$running);
	} while($running > 0);
	
	
		foreach($urlImagenes as $i => $datos)
		{
			// verificar si ya esta guardado no es necesario pedirlo
			$url = gererarURL($datos);
			if(isset($curl_array[$i]))
		    { 
				$res[$url]['content'] = curl_multi_getcontent($curl_array[$i]);
				$res[$url]['datos']	  = $datos;
				
				 $error = curl_error($curl_array[$i]);
			    // verificar si llego respuesta
			    if( $error ) 
			    {
					 
					$fichero = str_replace(' ','_',$error); 
					$f = fopen( './Errores/'.$fichero.'.txt','a');
					fwrite($f,$url.chr(13));
					fclose($f); 
					
					$imagenDefecto = cargarImagenDefecto404($error);
					if( !$imagenDefecto )
					{
						$res[$url]['content'] = cargarImagenDefecto();
						$res[$url]['cache'] = false; 
					}
					else
					{
						$res[$url]['content'] = salvarCACHE( $datos, $imagenDefecto );
						$res[$url]['cache'] = $datos; 
					}
				}	
			    else
				{
					
					$res[$url]['cache'] = salvarCACHE($datos, $res[$url]['content']);
					$res[$url]['datos'] = $datos;
				}
				 
				// si se pidio no guardar la imagen para renderizarla
				if (!$render) 
					$res[$url]['content'] = '';
		    }
		} 
	
	foreach($urlImagenes as $i => $url){
		if(isset($curl_array[$i]))
	    curl_multi_remove_handle($mh, $curl_array[$i]);
	}
	curl_multi_close($mh);  
	
	
	return      $res;
}

/**
 * Funcion para verificar si hay conexion con google
 * */
function verificarConexion()
{
	//return true;
	// cargar variables de configuracion para trabajo con proxys
	$proxy		= CONFIG_proxy; 
	$usuario	= CONFIG_usuario;
	$passw		= CONFIG_passw;
	
	$ch	= curl_init('http://www.google.com');
	//echo $pagina;
	//curl_setopt($ch, CURLOPT_URL, );
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	if($proxy)
	{
		//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); 
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, $usuario.':'.$passw); 
	}
	//curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID='.$_SESSION['idSesion']);
	curl_setopt($ch, CURLOPT_REFERER, 'http://localhost/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
    curl_setopt($ch, CURLOPT_USERAGENT, '	Mozilla/5.0 (X11; Linux x86_64; rv:8.0) Gecko/20100101 Firefox/8.0 Iceweasel/8.0');
    curl_setopt($ch, CURLOPT_ENCODING,'gzip, deflate');
    curl_setopt($ch, CURLOPT_HTTPHEADER,array("Proxy-Connection: keep-alive",
        "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
        "Accept-Language: es-es,es;q=0.8,en-us;q=0.5,en;q=0.3",
        "Accept: image/png,image/*;q=0.8,*/*;q=0.5" ));

	$aplazadasCadena	= curl_exec($ch);
    $error = curl_error($ch);
	curl_close($ch);
	if( $aplazadasCadena )
		return true;
	else
		return false;
}



?>
