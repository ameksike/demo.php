<?php 
/*
  * url 2 theme <?php echo get_stylesheet_directory_uri();
  * url global  <?php bloginfo('url');
  * url global  <?php echo get_permalink()
  * path        <?php echo TEMPLATEPATH
  * render view get_template_part("pag", "name");
  * */

function wp_theme_routing(){
    $_REQUEST["pag"] = (!isset($_REQUEST["pag"])) ? "home" :  $_REQUEST["pag"];
    get_template_part("pag", $_REQUEST["pag"]);
}

function url4page ( $page ){
	return  get_permalink()."&pag=$page";
}

function makeMenu($key){
    $lst = array(
        "INICIO"=>"home",
        "OBJETIVO"=>"object",
        "ESPECIALIDAES"=>"specialties",
        "LA CLINICA"=>"clinic",
        "GALERIA"=>"gallery",
        "EQUIPO"=>"team",
        "CONTACTO"=>"contact"
    );

    $htmlstr = "";
    foreach($lst as $k=>$i) $htmlstr .= ($i==$key) ? "<li class='active'> <a href='".url4page($i)."'>$k</a> </li>" : "<li> <a href='".url4page($i)."'>$k</a> </li>";
    return $htmlstr;
}