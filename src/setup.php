<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>	
        <link rel="stylesheet" href="res/css/app-header.css" />
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/introduction.css" />
		<title>Doosearch > Premiers pas</title>
		<script src="res/js/motors.js"></script>
        <script src="res/js/introduction.js"></script>
        <script src="res/js/color-selector.js"></script>
        <script src="res/js/convert.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="chooseMotors" style="display: none;">
				<?php include("res/php/introduction.php"); ?>
			</div>
			<img class="screenView" onclick="hideScreen();" src="res/img/choose.png" />
	
		</div>
	
        <ul class="toolBar">
            <li onclick="goBack();" onmouseover="showTooltip('Retour');" onmouseout="showTooltip('');"><img src="res/img/back.png" /></li>
            <li	onclick="goNext();" onmouseover="showTooltip('Continuer');" onmouseout="showTooltip('');"><img src="res/img/forward.png" /></li>

            <p class="tooltip">Tooltip</p>
        </ul>

        <?php include('res/php/color-selector.php'); ?>
		
        <div class="panel"><?php include("res/php/motors.php"); ?></div> <!-- Liste des moteurs de recherche -->
		
		<script>
			if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.32)
				$('.chooseMotors').css('display','inline-block');
			else
				document.location.href='search.php';
		</script>
    </body>
</html>