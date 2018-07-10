<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>	
        <link rel="stylesheet" href="res/css/app-header.css" />
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/quick-access.css" />
        <link rel="stylesheet" href="res/css/quick-access-popup.css" />
		<title>Doosearch > Accès rapide</title>
		<script src="res/js/windows.js"></script>
		<script src="res/js/quick-access.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="content">
                <ul class="tiles"></ul>
			</div>
	
		</div>
	
        <ul class="toolBar">
            <li onclick="openWindow('#addWebsite');" onmouseover="showTooltip('Ajouter un site web');" onmouseout="showTooltip('');"><img src="res/img/add.png" /></li>
            <!--li onclick="alert('Bientôt');" onmouseover="showTooltip('Rechercher un site web épinglé');" onmouseout="showTooltip('');"><img src="res/img/find.png" /></li-->
            
            <p class="tooltip">Tooltip</p>
        </ul>
        
        <?php include('res/php/quick-access.php'); ?>
    </body>
</html>