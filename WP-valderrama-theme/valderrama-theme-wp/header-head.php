<title><?php
         global $page, $paged;
  
         wp_title( '|', true, 'right' );
  
         // Agrega el nombre del blog.
         bloginfo( 'name' );
  
         // Agrega la descripción del blog, en la página principal.
         $site_description = get_bloginfo( 'description', 'display');
         if ( $site_description && ( is_home() || is_front_page() ) )
         	echo " | $site_description";
  
         // Agrega el número de página si es necesario:
         if ( $paged >= 2 || $page >= 2 )
         	echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max($paged, $page ) );
         ?>
</title>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap/bootstrap.min.js"></script>

