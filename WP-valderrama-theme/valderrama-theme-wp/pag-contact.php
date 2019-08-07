<html>
	<head>
        	<?php get_header("head"); ?>
        	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/css/map.css">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        	<script src="<?php echo get_stylesheet_directory_uri();?>/js/map.js"></script>
		<?php wp_head(); ?>
	</head>
	
	<body>
		<?php get_header(); ?>
		<!-- ======================== data local ============================ -->
        <article class="container bs-docs-container">
            <div class="col-md-8" id="mapa"> </div>
            <div class="col-md-4" id="dir">
                <p class="namel"> Clinica Dental Valderrama </p>

                <p> Clinica Dental Valderrama,
                Calle Luis Jorge Castaños, 23, 4º Dcha,
                Urbanización LAS CASCAJUELAS,
                28999 VALDECILLAS DE JARAMA,
                Madrid, Espana.</p>
                </br></br>
                <p> Pueden contactar nuestras asistentes para m&aacute;s informaci&oacute; a los siguientes <b>tel&eacute;fonos</b>: </p>

                <ul>
                   <li>91 728 96 05</li>
                   <li>91 728 96 06</li>
                   <li>91 728 96 07</li>
                   <li>91 728 96 08</li>
                    </br>
                   <li>901 33 55 33</li>
                   <li>901 33 55 34</li>
                   <li>901 33 55 35</li>
                </ul>
            </div>
        </article>
		<?php get_footer(); ?>
	</body>
</html>
