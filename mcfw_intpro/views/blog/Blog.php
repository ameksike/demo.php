<?php

include "../../core/Front.php";

if(isset($_REQUEST["id"])){
	if(isset($_REQUEST["_do"]) && $_REQUEST["_do"]=="savecoment"){
		$userid = Helper::this("User")->getId();	
		Helper::this("Noticias")->saveComentario(
			$_REQUEST["text"],
			$_REQUEST["id"],
			$userid
		);
	}
	$noticias = Helper::this("Noticias")->getNoticiaById($_GET["id"]);
	$comentario = Helper::this("Noticias")->getComentariosById($_GET["id"]);
} else $noticias = false;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en"><!-- InstanceBegin template="/Templates/page.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!--
    Created by Artisteer v2.0.2.15338
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Bitacora del Cadete</title>
    <!-- InstanceEndEditable -->
    <script type="text/javascript" src="../common/js/script.js"></script>
    <script type="text/javascript" src="../common/js/functions.js"></script>

    <link rel="stylesheet" href="../common/css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div class="PageBackgroundGlare">
        <div class="PageBackgroundGlareImage"></div>
    </div>
    <div class="Main">
        <div class="Sheet">
            <div class="Sheet-tl"></div>
            <div class="Sheet-tr"><div></div></div>
            <div class="Sheet-bl"><div></div></div>
            <div class="Sheet-br"><div></div></div>
            <div class="Sheet-tc"><div></div></div>
            <div class="Sheet-bc"><div></div></div>
            <div class="Sheet-cl"><div></div></div>
            <div class="Sheet-cr"><div></div></div>
            <div class="Sheet-cc"></div>
            <div class="Sheet-body">
                <div class="nav">
                    <ul class="artmenu">
                        <li><a href="../../index.php"><span><span>Inicio</span></span></a></li>
                        <li><a href="#"><span><span>Servicios</span></span></a>
                                        <ul>
                                <li><a href="../ingresar.php">Acceder</a></li>
                                <li><a href="../registrar/Registrar.php">Registrarse</a></li>
                            </ul>
                                    </li>
                        <li><a href="../buscar.php"><span><span>Búsqueda</span></span></a></li>
                        <li><a href="../noticias/Noticias.php"><span><span>Publicar</span></span></a></li>
                    </ul>
                    <div class="l">
                    </div>
                    <div class="r">
                        <div>
                        </div>
                    </div>
            </div>
                <div class="Header">
                    <div class="Header-jpeg"></div>
                    <div class="logo">
                        <h1 id="name-text" class="logo-name"><a href="#">Bitacora del Cadete</a></h1>
                        <div id="slogan-text" class="logo-text">"Sorprendenos con tu historia"</div>
                    </div>
                </div>
                <div class="contentLayout">
                    <div class="sidebar1">
                        <div class="Block">
                            <div class="Block-body">
                                <div class="BlockHeader">
                                    <div class="header-tag-icon">
                                        <div class="BlockHeader-text">
                                            Busqueda
                                        </div>
                                    </div>
                                    <div class="l"></div>
                                    <div class="r"><div></div></div>
                                </div>
                                <div class="BlockContent">
                                    <div class="BlockContent-body">
                                        <div><form method="get" id="newsletterform" action="javascript:void(0)">
                                        <input type="text" value="" name="email" id="s" style="width: 95%;" />
                                        <button class="Button" type="submit" name="search">
                                                <span class="btn">
                                                    <span class="t">Buscar</span>
                                                    <span class="r"><span></span></span>
                                                    <span class="l"></span>
                                                </span>
                                        </button>
                                        </form></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Block">
                            <div class="Block-body">
                                <div class="BlockHeader">
                                    <div class="header-tag-icon">
                                        <div class="BlockHeader-text">
                                            Enlaces
                                        </div>
                                    </div>
                                    <div class="l"></div>
                                    <div class="r"><div></div></div>
                                </div>
                                <div class="BlockContent">
                                    <div class="BlockContent-body">
                                        <div>
                                              <img src="../images/contact.jpg" alt="an image" style="margin: 0 auto;display:block;width:95%" />
                                        <br />
                                        <b>Company Co.</b><br />
                                        Las Vegas, NV 12345<br />
                                        Email: <a href="mailto:info@company.com">info@company.com</a><br />
                                        <br/>
                                        Phone: (123) 456-7890 <br/>
                                        Fax: (123) 456-7890
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- InstanceBeginEditable name="EditRegion3" -->
                    <div class="content">
		
<?php		
	if($noticias){
		echo Helper::this("Noticias")->getPost(
			"<b> Titulo: </b> ". $noticias["titulo"]."<br>".
			"<b> Texto: </b> ". $noticias["publicacion"]
		);	

		if(is_array($comentario))foreach($comentario as $i){
			$username = Helper::this("User")->getFullName($i["idUsuario"]);
			echo Helper::this("Noticias")->getPost(
				"<b> Autor: </b>".$username."<br>".
				"<b> Fecha: </b>".$i["fCreacion"]."<br>".
				"<b> Comentario: </b>".$i["comentario"]."<br>"
			);
		}
		
if(Helper::this("User")->isLogin())
		echo "	<br>
			<h3>Deja tu opinion</h3>

			<form action='../blog/Blog.php?_do=savecoment&id=".$_REQUEST["id"]."' method='post'>

				 <!-- textarea para el cuerpo del comentario -->
				 <textarea name='text' cols='73%' rows='7'></textarea>

				 <input type='submit' value='enviar comentario'/>
			</form> 
			<br>
		";	   
	
	}	
				   
?> 
                   
                    </div>

                    <div class="sidebar2">
                      <div class="Block">
                        <div class="Block-body">
                          <div class="BlockHeader">
                            <div class="header-tag-icon">
                              <div class="BlockHeader-text"> Highlights </div>
                            </div>
                            <div class="l"></div>
                            <div class="r">
                              <div></div>
                            </div>
                          </div>
                          <div class="BlockContent">
                            <div class="BlockContent-body">
                              <div>
                                <ul>
                                  <li><b>Jun 14, 2008</b>
                                    <p>Aliquam sit amet felis. Mauris semper, 
                                      velit semper laoreet dictum, quam 
                                      diam dictum urna, nec placerat elit 
                                      nisl in quam. Etiam augue pede, 
                                      molestie eget, rhoncus at, convallis 
                                      ut, eros. Aliquam pharetra.<br/>
                                      <a href="javascript:void(0)">Read more...</a> </p>
                                  </li>
                                </ul>
                                <ul>
                                  <li><b>Aug 24, 2008</b>
                                    <p>Aliquam sit amet felis. Mauris semper, 
                                      velit semper laoreet dictum, quam 
                                      diam dictum urna, nec placerat elit 
                                      nisl in quam. Etiam augue pede, 
                                      molestie eget, rhoncus at, convallis 
                                      ut, eros. Aliquam pharetra.<br/>
                                      <a href="javascript:void(0)">Read more...</a> </p>
                                  </li>
                                </ul>
                              </div>
                              <!--aqui -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- InstanceEndEditable --></div>
                <div class="cleared"></div><div class="Footer">
                    <div class="Footer-inner">
                        <a href="#" class="rss-tag-icon" title="RSS"></a>
                        <div class="Footer-text">
                            <p><a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a>
                                | <a href="#">Privacy Statement</a><br />
                                Copyright &copy; 2009 ---. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="Footer-background"></div>
                </div>
            </div>
        </div>
        <div class="cleared"></div>
        <!-- If you'd like to support Artisteer, having the "created with" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
        <p class="page-footer"><a href="http://www.artisteer.com/">Web Template</a> created with Artisteer.</p>
    </div>
    
</body>
<!-- InstanceEnd --></html>
