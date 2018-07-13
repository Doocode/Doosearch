<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/setup.css" />
		<title>Doosearch > Premiers pas</title>
        <script src="res/js/setup.js"></script>
        <script src="res/js/color-selector.js"></script>
        <script src="res/js/convert.js"></script>
        <script src="res/js/floating-buttons.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="content" style="display: none;">
				<?php include("res/php/setup.php"); ?>
			</div>
			<img class="screenView" onclick="hideScreen();" src="res/img/choose.png" />
	
		</div>
	
        <ul class="toolBar">
            <li onclick="goBack();" onmouseover="showTooltip('Retour');"><img src="res/img/back.png" /></li>
            <li	onclick="goNext();" onmouseover="showTooltip('Continuer');"><img src="res/img/forward.png" /></li>

            <p class="tooltip">Tooltip</p>
        </ul>

        <?php include('res/php/color-selector.php'); ?>
		
        <div class="panel"><?php include("res/php/motors.php"); ?></div> <!-- Liste des moteurs de recherche -->
		
		<script>
			if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.32)
				$('.content').css('display','inline-block');
			else
				document.location.href='search.php';
		</script>
    </body>
</html>