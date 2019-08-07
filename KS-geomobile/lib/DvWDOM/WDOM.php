<?php
/**
 *
 * @framework: Ksike
 * @package: Lib
 * @subpackage: WDOM
 * @version: 0.1 

 * @description: Esta libreria esta diseñada para manejar Wall como el DOM
 * @authors: ing. Antonio Membrides Espinosa
 * @making-Date: 07/01/2011
 * @update-Date: 07/01/2011
 * @license: GPL v3
 *
 */
define('WALL', 'Wall4PHP-1.1');
include 'WDOM/base/WWindow.php';
use Ksike\ksl\base\helpers\Assist;
class WDOM extends WWindow
{
	public function __construct($tile="New Wall App", $wurfl=false, $body=false)
	{
		parent::__construct($tile, true, $body);
		$path = dirname(__FILE__)."/WDOM/html/";
		$this->loadHtml(Assist::package("dir")->scan($path), $path);
	}
	
	public static function onFinish($lst, $path)
	{
		return $lst["file"];
	}
	
}
