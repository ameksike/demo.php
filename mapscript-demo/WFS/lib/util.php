<?php
class timeLog
{
	var $tInicio ; 
	var $total = 0;
	var $registro = '' ;
	function __construct()
	{
		$this->tInicio = microtime(true);
		
	}
	
	function registrar($mensaje)
	{
		$t 				= microtime(true);
		$this->registro .= $mensaje.($t-$this->tInicio).chr(13);
		$this->total 	+= ($t-$this->tInicio); 
		$this->tInicio 	= $t;
	}
	
	function salvarregistro()
	{
		$this->registro .= 'Tiempo Total '.$this->total;
		file_put_contents('./time/'.time().'.log',$this->registro);
	}
	
}


function convertir_wgs84_900913( $lon, $lat )
{
		
		// en esta conversion no se debe llegar a $lat == 90 o == -90
		if ($lon > 180 ) {
			$lon = 180;
		}
		elseif ($lon < -180) {
			$lon = -180;
			
		}
		// en esta conversion no se debe llegar a $lon == 180 o == -180
		if ($lat > 85.05112877978 ) {
			$lat = 85.05112877978;
		}
		elseif ($lat < -85.05112877978) {
			$lat = -85.05112877978;
		}
		//echo '<pre>';
		//print_r( $lon.' , '.$lat );
		
        $originShift = 20037508.342789244;//2 *  pi() * 6378137 / 2.0;
        $mx = $lon * $originShift / 180.0;
        $my =  log(  tan((90 + $lat) * pi() / 360.0 )) / (pi() / 180.0);
      
        $my = $my * $originShift / 180.0;
        return array( ($mx ) , ( $my ) );
}
        
 

//Tratar los errores E_NOTICE cuando no se envian los parametros necesarios.
function request($value) {
	if (isset($_REQUEST[$value]))
		return ($_REQUEST[$value]);
	elseif (isset($_REQUEST[strtolower($value)]))
		return ($_REQUEST[strtolower($value)]);
	elseif (isset($_REQUEST[strtoupper($value)]))
	   return ($_REQUEST[strtoupper($value)]);
	return (null);
}



function gererarURL($datos)
{ 
	// si existe un servido de replica diferente al de internet
	 if( CONFIG_server_mirror )
	{ 
		$datos['prefijo']  = str_replace( '/','_' , $datos['prefijo']);
		 $a = (  "http://".CONFIG_server_mirror."/khm/" . $datos['prefijo']."/".$datos['z']."/".$datos['x']."-".$datos['y']  );
		
		return ( $a );
	}	
	else  
		return  "http://".$datos['host'].$datos['numeroservidor'].$datos['dominio'].$datos['prefijo']."x=".$datos['x']."&y=".$datos['y']."&z=".$datos['z']."&s=".$datos['s'];
		
}	

function calcularBoxMercator( $x, $y, $z)
{
	
	$mapmeterspertile	= googlemaxmapmeters * 2 / (1 << $z	);	 
	$minx	= $x*$mapmeterspertile - googlemaxmapmeters; 
	$maxy	= googlemaxmapmeters  - $y*$mapmeterspertile; 
	
	$miny 	= $maxy - $mapmeterspertile;
	$maxx	= $minx + $mapmeterspertile ;
		
	 echo $x.' ;  '.$y;
	// minx, miny, maxx, maxy
	return array( $minx ,$miny  , $maxx, $maxy );
	
}
	


function  getgooglemaptileWGS84( $urlImagenes )
{ 
	
	
	$urlImagenesResult	= array();
	foreach ($urlImagenes as $url => $arregloDatos )
	{
		$pixelwidth 	= 256;
		$pixelheight 	= 256;
		$box			= calcularBoxMercator($arregloDatos['datos']['x'], $arregloDatos['datos']['y'], $arregloDatos['datos']['z']);
		
		echo '<pre>';
		
		print_r( $box );
		
				 
		
		$tmpFileTIF900913		= obtenerDireccionImagenEnCache( $arregloDatos['datos'], 'WGS-84');
		
		if (  !file_exists( $tmpFileTIF900913 ) ) { 
			// localizacion de la imagen original
			$tmpFilePNG		= $arregloDatos['cache'];
			// salida en GTiff 
			$tmpFileTIF		= obtenerDireccionImagenEnCache( $arregloDatos['datos'], 'GTiff');
		 
			georeferenciar( $pixelwidth, $pixelheight, $box, $tmpFilePNG, $tmpFileTIF  );
			
			$src_s = 'EPSG:900913';
			$src_d = 'EPSG:4326';
			
			Transformar( $src_s, $src_d, $pixelwidth, $pixelheight, $tmpFileTIF, $tmpFileTIF900913);
			 
			$image = new Imagick($tmpFileTIF900913);
			
			$image->setImageFormat('png'); 
			$content 		= $image;
			file_put_contents($tmpFileTIF900913,$content);
			//unlink( $tmpFileTIF );
			// unlink( $tmpFileTIF900913);
			$urlImagenesResult[$url] = array('content'=>$content,'cache'=>$tmpFileTIF,'datos'=>$arregloDatos['datos']);
		
		}
		else 
		{
			$content = file_get_contents($tmpFileTIF900913);
			$urlImagenesResult[$url] = array('content'=>$content,'cache'=>$tmpFileTIF900913,'datos'=>$arregloDatos['datos']);
		}
		
		
	}
	 die();
	return $urlImagenesResult;
		
	 	
}



function getUrls ( $Parametros , $render = true)
{
	
}


?>
