<?php
function georeferenciar( $pixelwidth, $pixelheight, $box, $tmpFilePNG, $tmpFileTIF  )
{
	// crear los 9 puntos de georeferenciacion
			// teniendo en cuenta las equivalencias
			/*------------------------------
			$pixelwidth	->	$googleMmaxx
			0			->	$googleMminx
			$pixelheight->	$googleMminy
			0			->	$googleMmaxy
			-------------------------------*/
			$googleMminx 	= $box[0];
			$googleMminy 	= $box[1];
			$googleMmaxx 	= $box[2];
			$googleMmaxy	= $box[3]; 
	// esquina inferior derecha
			$puntos	= '  -gcp 0 '.$pixelheight.' '.$googleMminx.' '.$googleMminy.' ';
			// esquina superior derecha
			$puntos	.= ' -gcp 0 0 '.$googleMminx.' '.$googleMmaxy.' ';
			// esquina superior izquierda
			$puntos	.= ' -gcp '.$pixelwidth.' 0 '.$googleMmaxx.' '.$googleMmaxy.'  ';
			// esquina inferior izquierda
			$puntos	.= ' -gcp '.$pixelwidth.' '.$pixelheight.' '.$googleMmaxx.' '.$googleMminy.' ';
			// centro 
			$puntos	.= ' -gcp '.($pixelwidth/2).' '.($pixelheight/2).' '.(($googleMmaxx+$googleMminx)/2).' '.(($googleMmaxy+$googleMminy)/2).' ';
			// mitad borde izquierda 
			$puntos	.= ' -gcp '.(0).' '.($pixelheight/2).' '.($googleMminx).' '.(($googleMmaxy+$googleMminy)/2).' ';
			// mitad borde derecha
			$puntos	.= ' -gcp '.($pixelwidth).' '.($pixelheight/2).' '.($googleMmaxx).' '.(($googleMmaxy+$googleMminy)/2).' ';
			// mitad borde superior 
			$puntos	.= ' -gcp '.($pixelwidth/2).' '.(0).' '.(($googleMmaxx+$googleMminx)/2).' '.($googleMmaxy).' ';
			// mitad borde inferior 
			$puntos	.= ' -gcp '.($pixelwidth/2).' '.($pixelheight).' '.(($googleMmaxx+$googleMminx)/2).' '.($googleMminy).' ';
 
			$georeferenciar = ('gdal_translate -a_srs EPSG:900913 -of GTiff  '.$puntos.' "'.$tmpFilePNG.'" "'.$tmpFileTIF.'"');
			// Georeferenciacion de la imagen
			  exec ($georeferenciar);
			
			
}

function  Transformar( $src_s, $src_d, $pixelwidth, $pixelheight, $tmpFileTIF, $tmpFileResult) 
{
	
	
	$trasnformar 	= ('gdalwarp -s_srs '.$src_s.' -t_srs '.$src_d.' -r cubic -of GTiff -ts  '.$pixelwidth.' '.$pixelheight.'  "'.$tmpFileTIF.'" "'.$tmpFileResult.'"');
			
	// Trasnformacion de la proyeccion de la imagen
		 	exec ($trasnformar);
	
	
}		
		

function TransformarConFichero( $pixelwidth, $pixelheight, $box, $tmpFile )
{
	
	$tmpFilePNG		= $tmpFile.'.png'; 
	$tmpFileResult	= $tmpFile.'RESULT.tiff';	
	$tmpFileRef		= $tmpFile.'.pgw';
		
	/*------------------------------
	$pixelwidth	->	$googleMmaxx
	0			->	$googleMminx
	$pixelheight->	$googleMminy
	0			->	$googleMmaxy
	-------------------------------*/
	$googleMminx 	= $box[0]; 
	$googleMminy 	= $box[1];
	$googleMmaxx 	= $box[2];
	$googleMmaxy	= $box[3]; 
	
	
	//Calculando los valores de la Referenciación de la Imagen PNG
	$varEscalaX = (($googleMmaxx-$googleMminx)/$pixelwidth);
	$varEscalaY = (($googleMminy-$googleMmaxy)/$pixelheight);
    //Contruyo arreglo para escritura en el fichero de referenciación		
        $strParametros = array();
	$strParametros[0]= $varEscalaX .chr(13);
	$strParametros[1]= "0" .chr(13);
	$strParametros[2]= "0" .chr(13);
	$strParametros[3]= $varEscalaY.chr(13);
	$strParametros[4]= ($googleMminx+($varEscalaX/2)).chr(13);
	$strParametros[5]= ($googleMmaxy+($varEscalaY/2));

	//crear fichero fichero
    file_put_contents($tmpFileRef,$strParametros);

	//Aplico la transformacion la imagen PNG Original, si utilizar gdal_translate... 
	
	$trasnformar 	= ('gdalwarp -s_srs EPSG:900913 -t_srs EPSG:4326 -r cubic -of GTiff -ts  '.$pixelwidth.' '.$pixelheight.'  "'.$tmpFilePNG.'" "'.$tmpFileResult.'"');
	exec( $trasnformar );
	 unlink($tmpFilePNG);
	
	unlink($tmpFileRef); 
}	



?>
