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
class MS_Admin
{
	//..........................Declaracion de Variables
	protected $objMap;
	public $imagpath;
	public $imagurl;
	public $maptmp;
	//..........................Declaracion de Metodos
	public function __construct($auto=true, $mapfile=0)
	{
		if (!extension_loaded("MapScript"))
			dl('php_mapscript.'.PHP_SHLIB_SUFFIX);

		$this->path	  = dirname(__FILE__) . '/../';
		$this->cache      = 5;
		$this->imagpath   = "log/img/";
		$this->imagurl    = "log/img/";
		$this->logpath    = 'log/error/trace.log';
		$this->maptmp     = 'src/generated_mapfile.map';
		$this->sldtmp     = 'src/generated_style.sld.xml';

		if($auto) $this->makeMap($mapfile);
	}

	public function makeMap($mapfile=0)
	{
		$path = $this->path . 'data/org/';
		// Limpiar lista de errores del servidor de mapas
		$this->clear();
		// Construir el objeto mapa sin fichero de configuracion
		$this->buildmap($mapfile);
		//  Definición de Capas y sus propiedades

		$layerOptions = include $this->path.'src/generated_style.lays.php';
		//$this->addLayerContor(		$path."Cuba_Provincias.tab"				);
		//$this->addLayer("caminos", 	$path."Cuba_Caminos.gml", 	$layerOptions['caminos']);
		$this->addLayer("puentes", 	$path."Cuba_Puentes.shp", 	$layerOptions['puentes']);
		$this->addLayer("costas", 	$path."Cuba_Costas.dxf", 	$layerOptions['costas']);
		//$this->addLayer("pueblos", 	$path."Cuba_Pueblos.json", 	$layerOptions['pueblos']);

		// Controla la salida de errores
		$this->showError();

		// Generar una salva temporar del mapa
		//$this->objMap->save($this->path.$this->maptmp);	
		// Generar una salva temporar de los estilos del mapa
		//$sld = $this->objMap->generateSLD();
		//file_put_contents($this->path.$this->sldtmp, $sld);
		// Aplicar un estilo a mapa desde un sld
		//$sld = file_get_contents($this->path.$this->sldtmp);
		//$this->objMap->applySLD($sld);

		// Rertornar Objeto Mapa
		return  $this->objMap;
	}

	public function buildmap($mapfile=0)
	{
		if(!$mapfile){
			$this->objMap = ms_newMapObj("");
			// Propiedades de las Cabeceras 
			$this->objMap->set("name","Cuba");
			$this->objMap->set("status", MS_ON);

			//$this->objMap->imagecolor->setRGB(0, 150, 0);
			$this->objMap->setSize(640, 480);
			$this->objMap->setExtent(-85, 17.7331838565022, -74, 26.2668161434978);
			$this->objMap->setProjection( "init=epsg:4267" );

			$this->objMap->imagecolor->setRGB(0, 0, 56);
			$this->objMap->selectOutputFormat("PNG24");
	
			//  Definición del objeto Web
			$this->objMap->web->set( "imagepath", $this->imagpath);
			$this->objMap->web->set( "imageurl",  $this->imagurl );

		}else $this->objMap = ms_newMapObj($mapfile);
	}

	public function showError()
	{
		$error = ms_GetErrorObj();
		$lserr = array();
		while($error)
		{
			if(!empty($error->message)) {
				$out = sprintf("Mapscript Error >> %s: %s \r\n", 
					$error->routine, 
					$error->message
				);
				file_put_contents($this->logpath, $out);
				$lserr[] = $out;
			}$error = $error->next();
		}
		return $lserr;
	}

	private function addLayerContor ($source)
	{
		$objLayer = ms_newLayerObj($this->objMap);
		$objLayer->set( "name", "dpa");
		$objLayer->set( "type", MS_LAYER_POLYGON);
		$objLayer->set( "status", MS_DEFAULT);
		$objLayer->set( "connection", $source);
		$objLayer->setConnectionType(MS_OGR);

		/*// Definición de la Clase 2 para la Capa
		$objClass2 = ms_newClassObj($objLayer);
		// Definición expresiones regulares o filtros por Clases 
		$expresion = "( \" [provincia] \" =~ /Cien/ )";
		$objClass2->setExpression($expresion);  
		// Definición de Etilos para la Clase 2
		$objStyle2 = ms_newStyleObj($objClass2);
		$objStyle2->color->setRGB(50, 250, 155);
		$objStyle2->outlinecolor->setRGB(0, 0, 0);

		// Definición de la Clase 1 para la Capa
		$objClass = ms_newClassObj($objLayer);
		// Definición de Etilos para la Clase
		$objStyle = ms_newStyleObj($objClass);
		$objStyle->color->setRGB(200, 150, 2);
		$objStyle->outlinecolor->setRGB(0, 0, 0);*/
		/*$laysld = $objLayer->generateSLD();
		file_put_contents($this->path.'src/generated_lay.sld.xml', $laysld);*/
		$laysld = file_get_contents($this->path.'src/generated_lay.sld.xml');
		$objLayer->applySLD($laysld);
	}

	public function addLayer($name, $source, $sld=array())
	{
		$sld = $this->formatSLD($sld);

		$objLayer = ms_newLayerObj($this->objMap);
		$objLayer->set( "name", $name); 
		$objLayer->set( "type", $sld['type']);
		$objLayer->set( "status", MS_DEFAULT);
		$objLayer->set( "connection", $source); 
		$objLayer->setConnectionType($sld['connectionType']);

		$objClass = ms_newClassObj($objLayer);
		$objStyle = ms_newStyleObj($objClass);

		$objStyle->color->setRGB(
			$sld['color']['R'], 
			$sld['color']['G'], 
			$sld['color']['B']
		);

		$objStyle->outlinecolor->setRGB(
			$sld['outlinecolor']['R'], 
			$sld['outlinecolor']['G'], 
			$sld['outlinecolor']['B']
		);
	}

	private function formatSLD($sld)
	{
		if(!isset($sld['outlinecolor']))  
			$sld['outlinecolor'] = array('G'=> 20, 'R'=> 23, 'B'=> '10');
		if(!isset($sld['color'])) 
			$sld['color'] = array('G'=> 50, 'R'=> 23, 'B'=>'90');
		if(!isset($sld['type'])) 
			$sld['type'] = MS_LAYER_POLYGON;
		if(!isset($sld['connectionType'])) 
			$sld['connectionType'] = MS_OGR;
		return $sld;
	}

	public function clear()
	{
		ms_ResetErrorList();
		$dir = $this->path. 'log/img/';
		$count = 0;
		if ($gestor = opendir($dir)) {
		    while (false !== ($archivo = readdir($gestor)))
			if ($archivo != "." && $archivo != "..") $count++;
		    closedir($gestor);
		}
		if($count > $this->cache) exec(" rm -r $dir* & chmod -R 777 $dir ");
	}

	public function navigate($mode=0, $factor=1, $center=0, $ext=0)
	{
		$factor = $factor ? $factor : 1;
		$ext = $ext ? $ext : (array) $this->objMap->extent;
		$center = $center ? $center : array(($ext['maxx'] - $ext['minx'])/2, ($ext['maxy'] - $ext['miny'])/2);

		$this->objMap->setextent($ext['minx'], $ext['miny'], $ext['maxx'], $ext['maxy']);
		$point  = ms_newpointObj();
		$point->setXY($center[0], $center[1]);
		$extent = ms_newrectObj();
		$extent->setextent($ext['minx'], $ext['miny'], $ext['maxx'], $ext['maxy']);
		$factor = $mode!=0 ? $mode * $factor : 1;
		$this->objMap->zoompoint($factor, $point, $this->objMap->width, $this->objMap->height, $extent);
	}

	public function getExtentAsJson($extent=0)
	{
		$extent = (!$extent) ? (array) $this->objMap->extent : $extent;
		if(isset($extent['_handle_'])) unset($extent['_handle_']);
		return json_encode($extent);
	}

	public function draw()
	{
		$imagen = $this->objMap->draw();
		return $imagen->saveWebImage();
	}

	public function queryByPoint($X, $Y, $layername='contorno')
	{
		ms_ResetErrorList();
		$X = $X ? $X : ( $this->objMap->extent->maxx - $this->objMap->extent->minx ) /2;
		$Y = $Y ? $Y : ( $this->objMap->extent->maxy - $this->objMap->extent->miny ) /2;
		$layername = $layername ? $layername : 'contorno';
		$msPoint = ms_newPointObj();
		$msPoint->setXY($X, $Y);

		if($msLayer = $this->objMap->getLayerByName($layername))
		{
print_r('');
			$status        = $msLayer->status;
			$maxscaledenom = $msLayer->maxscaledenom;
			$minscaledenom = $msLayer->minscaledenom;
			$msLayer->set('maxscaledenom', -1);
			$msLayer->set('minscaledenom', -1);
			$msLayer->set('status', MS_ON);

			$this->objMap->preparequery();
			$qresult = @$msLayer->queryByPoint($msPoint, MS_SINGLE, -1);
			if ($qresult == MS_SUCCESS)
			{
				$msLayer->open();
				$nresult = $msLayer->getNumResults();
				if ($nresult) 
				{
					$xresult = $msLayer->getResult(0);
					$sresult = $msLayer->getShape($xresult->tileindex, $xresult->shapeindex);
			    		$out     = $sresult->values;
					$sresult->free();
				}
				$msLayer->close();
			} 
			ms_ResetErrorList();
			$msLayer->set('maxscaledenom', $maxscaledenom);
			$msLayer->set('minscaledenom', $minscaledenom);
			$msLayer->set('status', $status);
			return  isset($out) ? $out : 'the source is empty or it is bat query';
		}else return false;
	}

	public function getinfo() 
	{
		return array(
			'name' => $this->objMap->name,
			'status' => $this->objMap->status,
			'width' => $this->objMap->width,
			'height' => $this->objMap->height,
			'projection' => $this->objMap->getProjection(),
			'extent' => (array) $this->objMap->extent,
			'layers' => $this->objMap->getAllLayerNames()
		);
	}
	/**
	 * converts pixel coordinates to geo
	 * @param pixPos coordinate in pixel
	 * @param pixMin minimum pix coordinate
	 * @param pixMax maximum pix coordinate
	 * @param geoMin minimum geo coordinate
	 * @param geoMax maximum geo coordinate
	 */
	public function pix2Geo($pixPos, $pixMin, $pixMax, $geoMin, $geoMax) {
		return $geoMin + ($pixPos - $pixMin) * ($geoMax - $geoMin) / ($pixMax - $pixMin);
	}
	/**
	 * converts geo coordinates to pix
	 * @param geoPos coordinate in geo
	 * @param pixMin minimum pix coordinate
	 * @param pixMax maximum pix coordinate
	 * @param geoMin minimum geo coordinate
	 * @param geoMax maximum geo coordinate
	 */
	public function geo2Pix($geoPos, $geoMin, $geoMax, $pixMin, $pixMax) {
		return $pixMin + ($geoPos - $geoMin) * ($pixMax - $pixMin) / ($geoMax - $geoMin);
	}	
}
