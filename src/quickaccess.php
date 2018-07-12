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
        <script src="res/js/floating-buttons.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="content">
                <div id="searchBar"><input type="text" placeholder="Recherche" onmouseover="showTooltip('Rechercher un site web épinglé');" spellcheck="false" autofocus /></div>
                <ul class="tiles"></ul>
			</div>
	
		</div>
	
        <ul class="toolBar">
            <li onclick="openWindow('#addWebsite');" onmouseover="showTooltip('Ajouter un site web');"><img src="res/img/add.png" /></li>
            <li onclick="$('#searchBar').slideToggle(); $('#searchBar input').val(''); updateView();" onmouseover="showTooltip('Rechercher un site web épinglé');"><img src="res/img/find.png" /></li>
            
            <p class="tooltip">Tooltip</p>
        </ul>
        
        <?php include('res/php/quick-access.php'); ?>
    </body>
</html>