<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setModule('search');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
			include("res/php/head.php"); 
			include("res/php/head-hub.php"); 
			include("res/php/head-search-engines.php");
		
			Lang::setModule('search');
		?>
        <title><?= $_APP['app_name'] .' > '. Lang::getText('search'); ?></title>
        
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
        <script src="res/js/jquery.scrollTo.min.js"></script>
    </head>

    <body>
        <?php 
			include("res/php/header.php");
			include("res/views/hub/background.php");
		
			Lang::setModule('search');
		?>
		
		<div class="central search">
			<div class="aligner"></div>
            
			<!-- L'application principale -->
            <div class="content home">
                <ul class="selected-engines" onclick="showSelectedEngines();" onmouseover="showTooltip('<?= Lang::getText('manage_selected_search_engines'); ?>');"></ul> <!-- Liste des moteurs sélectionné : pour la recherche groupé -->

                <br />

                <div id="form">
                    <input type="text" id="field" name="q" placeholder="<?= Lang::getText('type_here_to_search'); ?>" spellcheck="false" autofocus />
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
                <li onclick="showMotors();" onmouseover="showTooltip('<?= Lang::getText('change_search_engine'); ?>');"><img src="res/img/menu2.png" /></li>
                <div class="pinned">
                </div>
                <p class="tooltip">Tooltip</p>
            </ul>
        </div>
		
		<div class="panel"><?php include("res/php/search-engines.php"); ?></div> <!-- Liste des moteurs de recherche -->
    </body>
</html>