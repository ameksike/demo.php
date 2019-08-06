<?php
	function __autoload($class) 
	{
		$libs = array(
			"MDB4MySQL"=>"..".DIRECTORY_SEPARATOR."libs".DIRECTORY_SEPARATOR,
			"Controller"=> ""
		);

		$path = dirname(__FILE__).DIRECTORY_SEPARATOR;
		if(isset($libs[$class])) $path .= $libs[$class]."$class.php";
		else $path .= "..".DIRECTORY_SEPARATOR."controller".DIRECTORY_SEPARATOR."$class.php";

		if(!file_exists($path)) echo "Error: El fichero no existe: $path ";
		include @$path;
	}

	class Helper {
		public static $lst;
		public static function this($class){
			if(!isset(self::$lst[$class])) self::$lst[$class] = new $class; 
			return self::$lst[$class];
		}
	}
