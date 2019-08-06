<?php
include "../../core/Front.php";

if ( $_REQUEST['_do'] == "registrar" ) {

	$out = Helper::this("Registrar")->save(
		$_REQUEST["usuario"],
		$_REQUEST["nombre"],
		$_REQUEST["password"],
		$_REQUEST["email"]
	);
	header( 'Location: ../../index.php?registro=true' );
	die;
	/**/
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en"><!-- InstanceBegin template="/Templates/inicio.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!--
    Created by Artisteer v2.0.2.15338
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Bitacora del Cadete</title>

    <script type="text/javascript" src="../common/js/script.js"></script>
    <script type="text/javascript" src="../common/js/functions.js"></script>

    <link rel="stylesheet" href="../common/css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
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
                                <li><a href="ingresar.php">Acceder</a></li>
                                <li><a href="../registrar/Registrar.php">Registrarse</a></li>
                            </ul>
                                    </li>
                        
                        
                        <li><a href="buscar.php"><span><span>Búsqueda</span></span></a></li>
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
  
  <!-- InstanceBeginEditable name="EditRegion1" -->

    
  <div class="contentLayout">
    <div class="sidebar1">
      <div class="Block">
        <div class="Block-body">
          <div class="BlockHeader">
            <div class="header-tag-icon">
              <div class="BlockHeader-text"> Usuario </div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div></div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div>
                <form method="get" id="newsletterform" action="javascript:void(0); Validar();">
                  <input type="text" value="" name="email" id="s" style="width: 95%;" />
                  <button class="Button" type="submit" name="search"> <span class="btn"> <span class="t">Subscribe</span> <span class="r"><span></span></span> <span class="l"></span> </span> </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Block">
        <div class="Block-body">
          <div class="BlockHeader">
            <div class="header-tag-icon">
              <div class="BlockHeader-text"> Enlaces </div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div></div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div> <img src="../common/img/contact.jpg" alt="an image" style="margin: 0 auto;display:block;width:95%" /> <br />
                <b>Company Co.</b><br />
                Las Vegas, NV 12345<br />
                Email: <a href="mailto:info@company.com">info@company.com</a><br />
                <br/>
                Phone: (123) 456-7890 <br/>
                Fax: (123) 456-7890 </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="Post">
        <div class="Post-tl"></div>
        <div class="Post-tr">
          <div></div>
        </div>
        <div class="Post-bl">
          <div></div>
        </div>
        <div class="Post-br">
          <div></div>
        </div>
        <div class="Post-tc">
          <div></div>
        </div>
        <div class="Post-bc">
          <div></div>
        </div>
        <div class="Post-cl">
          <div></div>
        </div>
        <div class="Post-cr">
          <div></div>
        </div>
        <div class="Post-cc"></div>
        <div class="Post-body">
          <div class="Post-inner">
            <div class="PostMetadataHeader">
              <h2 class="PostHeaderIcon-wrapper"> <span class="PostHeader">Registro de Usuario</span> </h2>
            </div>
             <div class="PostContent">
            
		
	<form id="registrar" method="post" onSubmit='onsubmiting("registrar"); return false;'>
		<p>
			<label for="usuario">Usuario</label><br />
			<input name="usuario" id="usuario" type="text" value="" />
		</p>	
		<p>
			<label for="usuario">Nombre</label><br />
			<input name="nombre" id="nombre" type="text" value="" />
		</p>
		<p>
			<label for="password">Contrase&ntilde;a</label><br />
			<input name="password" id="password" type="password" value="" />
		</p>
		<p>
			<label for="re-password">Repetir Contrase&ntilde;a</label><br />
			<input name="re-password" id="re-password" type="password" value="" />
		</p>
		<p>
			<label for="email">Correo Electr&oacute;nico</label><br />
			<input name="email" id="email" type="text" value="" />
		</p>
 		<button class="Button" type="submit" name="search"> <span class="btn"> <span class="t">Registrarse</span> <span class="r"><span></span></span> <span class="l"></span> </span> </button>
		
	</form>
            <form method="get" id="newsletterform" action="javascript:void(0)">
            
		</p>
		
	</form>
            
            </div>
            <div class="cleared"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="sidebar2">
      <div class="Block">
        <div class="Block-body">
          <div class="BlockHeader">
            <div class="header-tag-icon">
              <div class="BlockHeader-text"> Usuario </div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div></div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div>
                <!--aki va el codigo de las funciones ke se kieran poner debajo de Usuario -->
              </div>
              <!--aqui -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cleared"></div>
  <div class="Footer">
    <div class="Footer-inner"> <a href="#" class="rss-tag-icon" title="RSS"></a>
      <div class="Footer-text">
        <p><a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a> | <a href="#">Privacy Statement</a><br />
          Copyright &copy; 2009 ---. All Rights Reserved.</p>
      </div>
    </div>
    <div class="Footer-background"></div>
  </div>
  <!-- InstanceEndEditable --></div>
        </div>
        <div class="cleared"></div>
        <!-- If you'd like to support Artisteer, having the "created with" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
        
    </div>
    
</body>
<!-- InstanceEnd --></html>
