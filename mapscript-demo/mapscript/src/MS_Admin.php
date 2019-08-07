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
	public function __construct()
	{
		if (!extension_loaded("MapScript"))
			dl('php_mapscript.'.PHP_SHLIB_SUFFIX);

		$this->path	  = dirname(__FILE__) . '/../';
		$this->imagpath   = "log/img/";
		$this->imagurl    = "log/img/";
		$this->maptmp     = 'src/mapfile_generated.map';
		$this->logpath    = 'log/error/trace.log';
		$this->cache      = 5;
	}

	public function makeMap()
	{
		$path = $this->path . 'data/org/';
		// Limpiar lista de errores del servidor de mapas
		$this->clear();
		// Construir el objeto mapa sin fichero de configuracion
		$this->buildmap();
		//  Definición de Capas y sus propiedades
		$layerOptions['caminos']['color']['R']	= 20;
		$layerOptions['caminos']['color']['G']	= 120;
		$layerOptions['caminos']['color']['B']	= 20;
		$layerOptions['caminos']['outlinecolor']['R']	= 1;
		$layerOptions['caminos']['outlinecolor']['G']	= 3;
		$layerOptions['caminos']['outlinecolor']['B']	= 4;
		$layerOptions['caminos']['type'] = MS_LAYER_LINE;
		$layerOptions['puentes']['color']['R']	= 200;
		$layerOptions['puentes']['color']['G']	= 11;
		$layerOptions['puentes']['color']['B']	= 2;
		$layerOptions['puentes']['type'] = MS_LAYER_LINE;
		$layerOptions['costas']['type'] = MS_LAYER_POINT;
		$layerOptions['pueblos']['color']['R']	= 150;
		$layerOptions['pueblos']['color']['G']	= 250;
		$layerOptions['pueblos']['color']['B']	= 150;

		$this->addLayerContor(		$path."Cuba_Provincias.tab"				);
		$this->addLayer("caminos", 	$path."Cuba_Caminos.gml", 	$layerOptions['caminos']);
		$this->addLayer("puentes", 	$path."Cuba_Puentes.shp", 	$layerOptions['puentes']);
		$this->addLayer("costas", 	$path."Cuba_Costas.dxf", 	$layerOptions['costas']);
		//$this->addLayer("pueblos", 	$path."Cuba_Pueblos.json", 	$layerOptions['pueblos']);

		// Controla la salida de errores
		$this->showError();
		// Generar una salva temporar del mapa
		$this->objMap->save($this->path.$this->maptmp);
		// Rertornar Objeto Mapa
		return  $this->objMap;
	}

	public function buildmap()
	{
		$this->objMap = ms_newMapObj("");
		// Propiedades de las Cabeceras 
		$this->objMap->set("name","Cuba");
		$this->objMap->set("status", MS_ON);
		$this->objMap->setSize(640, 480);
		$this->objMap->setExtent(-85, 17.7331838565022, -74, 26.2668161434978);
		$this->objMap->setProjection( "init=epsg:4267" );
	
		$this->objMap->imagecolor->setRGB(0, 0, 56);
		$this->objMap->selectOutputFormat("PNG24");
	
		//  Definición del objeto Web
		$this->objMap->web->set( "imagepath", $this->imagpath);
		$this->objMap->web->set( "imageurl",  $this->imagurl );
	}

	public function showError()
	{
		$error = ms_GetErrorObj();
		while($error)
		{
			if(!empty($error->message)) {
				$out = sprintf("Mapscript Error >> %s: %s \r\n", 
					$error->routine, 
					$error->message
				);
				file_put_contents($this->logpath, $out);
			}
			$error = $error->next();
		}
	}

	public function addLayerContor ($source)
	{
		$objLayer = ms_newLayerObj($this->objMap);
		$objLayer->set( "name", "contornos");
		$objLayer->set( "type", MS_LAYER_POLYGON);
		$objLayer->set( "status", MS_DEFAULT);
		$objLayer->set( "connection", $source);
		$objLayer->setConnectionType(MS_OGR);
		//$objLayer->set( "connectiontype", MS_OGR); // deprecate

		// Definición de la Clase 2 para la Capa
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
		$objStyle->outlinecolor->setRGB(0, 0, 0);
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

	public function formatSLD($sld)
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

	public function clear(){
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
}
