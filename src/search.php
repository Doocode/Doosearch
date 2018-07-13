<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        
        <title>Doosearch > Rechercher</title>
        
        <!-- Chargement des fichiers CSS -->
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/search.css" />
        <link rel="stylesheet" href="res/css/selected-engines.css" />
        <link rel="stylesheet" href="res/css/quick-access.css" />
        
        <!-- Chargement des fichiers JavaScript -->
		<script src="res/js/search.js"></script>
		<script src="res/js/selected-engines.js"></script>
		<script src="res/js/pinned-motors.js"></script>
		<script src="res/js/speeddial.js"></script>
        <script src="res/js/floating-buttons.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
            
			<!-- L'application principale -->
            <div class="content">
                <ul class="selected-engines" onclick="showSelectedEngines();" onmouseover="showTooltip('Gérer les moteurs sélectionnés');"></ul> <!-- Liste des moteurs sélectionné : pour la recherche groupé -->

                <br />

                <div id="form">
                    <input type="text" id="field" name="q" placeholder="Tapez votre recherche ici" onmouseover="showTooltip('Tapez ici votre recherche');" spellcheck="false" autofocus />
                    <button id="clr" onclick="$('#field').val('');" onmouseover="showTooltip('Effacer la zone de recherche');"><img src="res/img/clear.png" /></button>
                    <button onclick="validateForm();" onmouseover="showTooltip('Lancer la recherche');"><img src="res/img/search.png" /></button>
                </div>
            </div>
		</div>
		
		<!-- Liste des sites web épinglés -->
        <div id="quick-access">
            <ul class="tiles"> </ul>
        </div>
	
        <ul class="toolBar">
            <li onclick="showMotors();" onmouseover="showTooltip('Changer de moteur de recherche');"><img src="res/img/menu2.png" /></li>
            <div class="pinned">
            </div>
            <p class="tooltip">Tooltip</p>
        </ul>
		
		<div class="panel"><?php include("res/php/motors.php"); ?></div> <!-- Liste des moteurs de recherche -->
	
		<!-- Le menu du clic droit sur la liste des moteur -->
		<ul class="contextMenu">
			<h4>Type de liste</h4>
			<li id="icones" onclick="showAsList(false);"><img src="res/img/icons.png" /><span>Afficher sous forme d'icônes</span></li>
			<li id="liste" onclick="showAsList(true);"><img src="res/img/list.png" /><span>Afficher sous forme de liste</span></li>
		</ul>
    </body>
</html>