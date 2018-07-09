<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        
        <title>Doosearch > Rechercher</title>
        
        <!-- Chargement des fichiers CSS -->
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/app.css" />
        <link rel="stylesheet" href="res/css/app-header.css" />
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
        <link rel="stylesheet" href="res/css/selected-motors.css" />
        <link rel="stylesheet" href="res/css/pinned-websites.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
		<link rel="icon" type="image/png" href="res/img/favicon.png" />
        
        <!-- Chargement des fichiers JavaScript -->
		<script src="res/js/app.js"></script>
		<script src="res/js/motors.js"></script>
		<script src="res/js/selected-motors.js"></script>
		<script src="res/js/pinned-motors.js"></script>
		<script src="res/js/speeddial.js"></script>
		<script src="res/js/windows.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    </head>

    <body onresize="resizeEvent();" onscroll="scrollEvent();">
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<?php include("res/php/app.php"); ?> <!-- L'application principale -->
		</div>
	
        <ul class="toolBar">
            <li onclick="showMotors();" onmouseover="showTooltip('Changer de moteur de recherche');" onmouseout="showTooltip('');"><img src="res/img/menu2.png" /></li>
            <li	onclick="document.location.href='#speedDial';" onmouseover="showTooltip('Sites épinglés');" onmouseout="showTooltip('');"><img src="res/img/bookmarks.png" /></li>

            <div class="pinned">
            </div>
            <li	onclick="addPinnedMotors();" onmouseover="showTooltip('Epingler un moteur');" onmouseout="showTooltip('');"><img src="res/img/add.png" /></li>

            <p class="tooltip">Tooltip</p>
        </ul>
		
		<?php include("res/php/speeddial.php"); ?> <!-- Liste des sites web épinglés -->
		
		<div class="panel"><?php include("res/php/motors.php"); ?></div> <!-- Liste des moteurs de recherche -->
	
		<!-- Le menu du clic droit sur la liste des moteur -->
		<ul class="contextMenu">
			<li style="display: none;">Rechercher un moteur</li>
			
			<h4>Forme de la liste</h4>
			<li id="sideScreen" onclick="resizePanel(false);"><img src="res/img/side.png" /><span>Afficher sur le côté</span></li>
			<li id="fullScreen" onclick="resizePanel(true);"><img src="res/img/full-screen.png" /><span>Afficher en plein écran</span></li>
			<br />

			<h4>Type de liste</h4>
			<li id="icones" onclick="showAsList(false);"><img src="res/img/icons.png" /><span>Afficher sous forme d'icônes</span></li>
			<li id="liste" onclick="showAsList(true);"><img src="res/img/list.png" /><span>Afficher sous forme de liste</span></li>
			
			<h4>Fermer la liste</h4>
			<li onclick="showMotors();"><img src="res/img/close2.png" /><span>Fermer</span></li>
		</ul>
    </body>
</html>