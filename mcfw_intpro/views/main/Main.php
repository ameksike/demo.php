<?php

if(isset($_REQUEST["accion"]) ){
	if( $_REQUEST["accion"]=="login"){
		Helper::this("User")->login($_REQUEST["user"], $_REQUEST["pass"]);
	}		
	else if($_REQUEST["accion"]=="logout"){  
		Helper::this("User")->logout();

	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en"><!-- InstanceBegin template="views/common/templates/inicio.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!--
    Created by Artisteer v2.0.2.15338
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Bitacora del Cadete</title>

    <script type="text/javascript" src="views/common/js/script.js"></script>
    <script type="text/javascript" src="views/common/js/functions.js"></script>

    <link rel="stylesheet" href="views/common/css/style.css" type="text/css" media="screen" />
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
                        <li><a href="index.php"><span><span>Inicio</span></span></a></li>
                        <li><a href="#"><span><span>Servicios</span></span></a>
                                        <ul>
                                <li><a href="pages/ingresar.php">Acceder</a></li>
                                <li><a href="views/registrar/Registrar.php">Registrarse</a></li>
                            </ul>
                                    </li>
                        
                        
                        <li><a href="pages/buscar.php"><span><span>Búsqueda</span></span></a></li>
                        <li><a href="views/noticias/Noticias.php"><span><span>Publicar</span></span></a></li>
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
              <div class="BlockHeader-text">Busqueda</div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div></div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div>
		<form action='views/noticias/Noticias.php' method='post'>
                  <input type="text" name="dateini" />
                  <input type="text" name="dateend" />
                  <button class="Button" type="submit" name="search" > <span class="btn"> <span class="t">Buscar</span> <span class="r"><span></span></span> <span class="l"></span> </span> </button>
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
              <div class="BlockHeader-text">Enlaces</div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div></div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div> <img src="views/common/img/contact.jpg" alt="an image" style="margin: 0 auto;display:block;width:95%" /> <br />
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
              <h2 class="PostHeaderIcon-wrapper"> <span class="PostHeader">Bienvenido</span> </h2>
            </div>
            <div class="PostContent"> <img class="article" src="views/common/img/spectacles.gif" alt="an image" style="float: left" />
              <h1>Nota del autor  de esta Web</h1>
              <p>Esta es una web para todas aquellas personas que quieran publicar sus escritos, ya sean historias o peque&ntilde;os trabajos de investigativos que deseen opiniones sobre el mismo. Ya que esta pagina tiene el objetivo de darle a los usuarios un peque&ntilde;o lugar donde hablar sobre todo aquello que sea literatura y darse a conocer los peque&ntilde;os escritores que estan interesados en dejar las libretas y salir a la luz.</p>
              
              
            </div>
            <div class="cleared"></div>
          </div>
        </div>
      </div>
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
              <h2 class="PostHeaderIcon-wrapper"> <span class="PostHeader">Comportamiento en esta p&aacute;gina</span> </h2>
            </div>
            <div class="PostContent">
            <h5>Para todos los usuarios:</h5>
              <p>Todos aquellos usuarios que sean amonestados por publicaciones que no cumplan con las normas que aqui se plantean:</p>

				<ul>
					<li>Publicaciones fuera de tema </li>
					<li>Utilizacion de palabras obsenas en sus publicaciones o sobrenombres.</li>
					<li>Criticas sobre politica.</li>
				</ul>

				<p>Seran sancionados severamente con la congelacion de su cuenta de usuario por tiempo indefinido(en dependencia de la grabedad de la infraccion) y la eliminacion de la publicacion con la que incumplio.</p>
              <blockquote>
                <p>  &#8220;No hay malos escritores sino criticos con un punto de vista distinto.&#8221;  <br />
                  -Dario Viejo </p>
              </blockquote>
              <br />
              
              
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
              <div class="BlockHeader-text"> Login </div>
            </div>
            <div class="l"></div>
            <div class="r">
              <div>  </div>
            </div>
          </div>
          <div class="BlockContent">
            <div class="BlockContent-body">
              <div>
<?php
	if(Helper::this("User")->isLogin()){
		echo "
			<form method='post' rows='7' >
			      <input type='hidden' name='accion' value='logout' />
			      <input type='submit' value='Salir'/>
			</form>
		";
	}else{
		echo "
			<form method='post' rows='7' >

			      <label> Usuario: <input type='text' name='user' width='13' />  </label>
			      <label> Contraseña:<input type='password' name='pass' width='13' />  </label>

			      <input type='hidden' name='accion' value='login' />
			      <input type='submit' value='Entrar'/>
			</form>
		";
	}
?>


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
    <div class="Footer-inner"> 
      <div class="Footer-text">
        <p><a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a> | <a href="#">Privacy Statement</a><br />
          Copyright &copy; 2011 ---. Todos los Derechos Reservados.</p>
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
