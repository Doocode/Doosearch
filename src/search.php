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
		<script src="res/js/pinned-engines.js"></script>
		<script src="res/js/speeddial.js"></script>
        <script src="res/js/floating-buttons.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
            
			<!-- L'application principale -->
            <div class="content home">
                <ul class="selected-engines" onclick="showSelectedEngines();" onmouseover="showTooltip('Gérer les moteurs sélectionnés');"></ul> <!-- Liste des moteurs sélectionné : pour la recherche groupé -->

                <br />

                <div id="form">
                    <input type="text" id="field" name="q" placeholder="Tapez votre recherche ici" spellcheck="false" autofocus />
                    <button class="cleaner" onclick="$('#field').val(''); $('#form').removeClass('withCleaner');"><img src="res/img/clear.png" /></button>
                    <button onclick="validateForm();"><img src="res/img/search.png" /></button>
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
		
		<div class="panel"><?php include("res/php/search-engines.php"); ?></div> <!-- Liste des moteurs de recherche -->
    </body>
</html>