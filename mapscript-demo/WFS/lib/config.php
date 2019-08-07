<?php
$config = parse_ini_file(WMS_GOOGLE_HOME.'config/config.ini');
//Tomar maximo factor 22 al nivel que googlelo da.
define('googlemaxzoomfactor' , $config['googlemaxzoomfactor']);
define('googlemaxmapmeters' , $config['googlemaxmapmeters']);
define('dir_cache_google' , $config['dir_cache_google']);
define('dir_tmp' , $config['dir_tmp']);
define('CONFIG_proxy' , $config['proxy']);
define('CONFIG_usuario' , $config['usuario']);
define('CONFIG_passw' , $config['passw']);

define('CONFIG_rate' , $config['rate']);
define('CONFIG_server_mirror' , $config['server_mirror']);
define('CONFIG_microsecond_request_time' , $config['microsecond_request_time']);

?>
