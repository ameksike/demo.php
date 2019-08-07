<?php
//comprueba que se cargue la libreria MapScript
if (!extension_loaded("MapScript"))
	dl('php_mapscript.'.PHP_SHLIB_SUFFIX);

	
switch ($_REQUEST["request"]) {
    case "GetCapabilities":
        /* Indica qué capas ofrece el servicio y cuales son sus características 
          (nombre, título, sistema de coordenadas, etc.), además aporta información
          sobre operaciones soportadas. (Obligatorio)*/
        $url = "http";
        if (isset($_SERVER["HTTPS"]))
            if ($_SERVER["HTTPS"] != "")
                $url.="s";
        $url.="://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"] . "?";
     header ("Location: http://10.12.167.32/cgi-bin/mapserv?MAP=/var/www/WFS/test.map&SERVICE=WFS&VERSION=1.1.0&REQUEST=GetCapabilities");
 
        break;
    case "DescribeFeatureType":
        /* Devuelve la estructura (campos y tipos) de las capas disponibles por el 
          servicio. (WFS básico)(Obligatorio) */         
      header("Location:http://10.12.167.32/cgi-bin/mapserv?MAP=/var/www/WFS/test.map&SERVICE=WFS&VERSION=1.1.0&REQUEST=DescribeFeatureType");
     
        break;
    case "GetGMLObject":
        /* Permite obtener features y elementos por su ID de un WFS. (XLink WFS). 
          Dado el ID de un elemento (XLinks ID) devuelve el GML que describe dicho elemento. */
          
        break;
    case "GetFeature":
        /* Permite realizar peticiones de información. Se debe identificar la capa sobre 
          la que se quiere solicitar la información y devuelve un GML con las geometrías
          y atributos solicitados. (WFS básico) */
         header("Location:http://10.12.167.32/cgi-bin/mapserv?MAP=/var/www/WFS/test.map&SERVICE=WFS&VERSION=1.1.0&REQUEST=GetFeature&TYPENAME=mundo&");

        break;
    case "Transaction":
        /* Permite realizar operaciones de edición (crear, eliminar o modificar elementos). (WFS-T) */
        break;
    case "LockFeature":
        /* Permite el bloqueo de una o varias capas mientras está teniendo lugar una operación 
          transaccional. (Opcional en WFS-T) */
        break;
}
?>
		 





