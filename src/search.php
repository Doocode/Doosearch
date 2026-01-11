<?php 
include("res/php/core.php"); 
$lang->setSection('search');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        
        <?php $lang->setSection('search'); ?>
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('search'); ?></title>
        
        <!-- Chargement des fichiers CSS -->
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/search.css" />
        <link rel="stylesheet" href="res/css/selected-engines.css" />
        <link rel="stylesheet" href="res/css/quick-access.css" />
        
        <!-- Chargement des fichiers JavaScript -->
		<script src="res/js/search.js"></script>
		<script src="res/js/selected-engines.js.php"></script>
		<script src="res/js/pinned-engines.js.php"></script>
		<script src="res/js/speeddial.js"></script>
        <script src="res/js/floating-buttons.js"></script>
        <script src="//cdn.jsdelivr.net/jquery.scrollto/2.1.2/jquery.scrollTo.min.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        
        <?php $lang->setSection('search'); ?>
		
		<div class="central">
			<div class="aligner"></div>
            
			<!-- L'application principale -->
            <div class="content home">
                <ul class="selected-engines" onclick="showSelectedEngines();" onmouseover="showTooltip('<?= $lang->getKey('manage_selected_search_engines'); ?>');"></ul> <!-- Liste des moteurs sélectionné : pour la recherche groupé -->

                <br />

                <div id="form">
                    <input type="text" id="field" name="q" placeholder="<?= $lang->getKey('type_here_to_search'); ?>" spellcheck="false" autofocus />
                    <button class="cleaner" onclick="$('#field').val(''); $('#form').removeClass('withCleaner');"><img src="res/img/clear.png" /></button>
                    <button onclick="validateForm();"><img src="res/img/search.png" /></button>
                </div>
            </div>
		</div>
		
		<!-- Liste des sites web épinglés -->
        <div id="quick-access">
            <ul class="tiles"> </ul>
        </div>
	
        <div id="toolBarHolder">
            <ul class="toolBar">
                <li onclick="showMotors();" onmouseover="showTooltip('<?= $lang->getKey('change_search_engine'); ?>');"><img src="res/img/menu2.png" /></li>
                <div class="pinned">
                </div>
                <p class="tooltip">Tooltip</p>
            </ul>
        </div>
		
		<div class="panel"><?php include("res/php/search-engines.php"); ?></div> <!-- Liste des moteurs de recherche -->
    </body>
</html>