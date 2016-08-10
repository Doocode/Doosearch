<header id="head">
	<div class="ctn">
		<div>
			<img class="btnMenu" onclick="showHeaderMenu();" src="res/img/menu2.png" />
			<p><a href="index.php"><img src="res/img/white-flat-logo-header.png" /></a></p>
		</div>
		
		<img class="btnFamily" onclick="showFamily();" src="res/img/menu.png" />
	</div>
	
	<ul>
		<li>
			<a href="index.php">
				<span>Accueil</span>
			</a>
		</li>
		<li id="configPage">
			<a href="configuration.php">
				<span>Configuration</span>
			</a>
		</li>
		<li>
			<a href="discover.php">
				<span>Découvrir</span>
			</a>
		</li>
		<li>
		<a href="download.php">
				<span>Télécharger</span>
			</a>
		</li>
		<li>
			<a href="contact.php">
				<span>Contact</span>
			</a>
		</li>
		<li>
			<a href="about.php">
				<span>A propos</span>
			</a>
		</li>
	</ul>
</header>

<nav class="family">
	<ul>
		<h1>Doocode Family</h1>
		<li>
			<a href="http://doocode.esy.es/">
				<img src="http://doo.zz.vc/res/img/white-flat-logo.png" />
				<span>Doocode</span>
			</a>
		</li>
		<li>
			<a href="http://doochronos.esy.es/">
				<img src="http://doochronos.esy.es/res/img/white-flat-logo.png" />
				<span>Doochronos</span>
			</a>
		</li>
		<li>
			<a href="http://doosearch.esy.es/">
				<img src="http://doosearch.esy.es/res/img/white-flat-logo.png" />
				<span>Doosearch</span>
			</a>
		</li>
		<li>
			<a href="http://dooscape.esy.es/">
				<img src="http://dooscape.esy.es/res/img/white-flat-logo.png" />
				<span>Dooscape</span>
			</a>
		</li>
	</ul>
</nav>

<script src="res/js/jquery-3.1.0.min.js"></script>
<script src="res/js/header.js"></script>
<script>
	if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.3)
		$('#configPage').css('display','none');
</script>