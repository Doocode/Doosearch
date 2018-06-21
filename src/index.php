<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>	
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/introduction.css" />
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui propose la recherche à partir d'un moteur de recherche selectionné parmis plusieurs, parmis Google, Youtube, Bing et plein d'autre." />
		<title>Doosearch de Doocode</title>
		<script src="res/js/motors.js"></script>
        <script src="res/js/introduction.js"></script>
        <script src="res/js/color-selector.js"></script>
        <script src="res/js/convert.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="redirect">
				<h1>Veuillez patienter</h1>
			</div>
			<div class="chooseMotors" style="display: none;">
				<?php include("res/php/introduction.php"); ?>
			</div>
			<img class="screenView" onclick="hideScreen();" src="res/img/choose.png" />
	
		</div>
		
        <div class="panel"><?php include("res/php/motors.php"); ?></div> <!-- Liste des moteurs de recherche -->
		
		<script>
			if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.31)
			{
				$('.redirect').css('display','none');
				$('.chooseMotors').css('display','inline-block');
			}
			else
				document.location.href='home.php';
		</script>
    </body>
</html>