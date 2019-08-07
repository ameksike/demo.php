<?php
/**
 *
 * @package: app
 * @subpackage: src
 * @version: 0.1
 * @description: Clase para la administración de mapas sobre Mapserver
 * @authors: ing. Antonio Membrides Espinosa
 * @update: 03/02/2012
 * @license: GPL v3
 *
 */
	include "MS_Admin.php";

	// static map
	   $ms_Adm = new MS_Admin(true, "src/mapfile.map");
	
	/*$ms_Adm = new MS_Admin();*/

	//... in controls ...
	if ( !isset($_REQUEST["full"]) && isset($_REQUEST["action"])) {
		$extent = json_decode($_REQUEST["extent"], true);
		$center = isset($_REQUEST["mapa_x"]) ? array( $_REQUEST["mapa_x"], $_REQUEST["mapa_y"] ) : 0;

		if($_REQUEST["action"] == 'q')
		{ 	//... Query
			$x = $ms_Adm->pix2Geo($center[0], 0, 640, $extent['minx'], $extent['maxx']);
			$y = $ms_Adm->pix2Geo($center[1], 0, 480, $extent['miny'], $extent['maxy']);
			$data = $ms_Adm->queryByPoint($x, $y, $_REQUEST["query"]);
		}

		$ms_Adm->navigate($_REQUEST["action"], $_REQUEST["factor"], $center, $extent);
		$extent = $ms_Adm->getExtentAsJson();
		
	}else if(isset($_REQUEST["extent"])) $extent = $_REQUEST["extent"];
	$inf = $ms_Adm->getinfo();
	//... out controls ...

	$URL = $ms_Adm->draw();
?>
