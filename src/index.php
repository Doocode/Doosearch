<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="res/css/animate.css" />
        <link rel="stylesheet" href="res/css/main.css" />
        <link rel="stylesheet" href="res/css/header.css" />		
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
        <link rel="stylesheet" href="res/css/introduction.css" />
		<link rel="icon" type="image/png" href="res/img/favicon.png" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui propose la recherche à partir d'un moteur de recherche selectionné parmis plusieurs, parmis Google, Youtube, Bing et plein d'autre." />
		<title>Doosearch de Doocode</title>
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
				$('body').css('background','rgb(255,100,0)');
				$('.chooseMotors').css('display','inline-block');
			}
			else
				document.location.href='home.php';
		</script>
    </body>
</html>