
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
                <?php echo makeMenu($_REQUEST["pag"]); ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://www.twitter.com"><span class="icon icon-twitter"></span></a></li>
				<li><a href="http://www.facebook.com"><span class="icon icon-facebook"></span></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"> </span><b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="#"><b>(EN)</b> INGLES</a></li>
					  <li><a href="#"><b>(ES)</b> ESPA&#209;OL</a></li>
					</ul>
				</li>
				<li><a href="#"><span class="glyphicon glyphicon-envelope"/></a></li>
			</ul>
		</nav>
	</div>
</header>
