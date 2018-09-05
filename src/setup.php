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
        
        <ul class="pagination">
            <li class="active" id="intro">
                <p>Introduction</p>
                <ul class="slides"></ul>
            </li>
            <li id="customize">
                <p>Personnalisation</p>
                <ul class="slides"></ul>
            </li>
            <li id="ending">
                <p>Finalisation</p>
                <ul class="slides"></ul>
            </li>
        </ul>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="content">
				<?php include("res/php/setup.php"); ?>
			</div>
			<img class="screenView" onclick="hideScreen();" src="res/img/choose.png" />
		</div>
	
        <ul class="toolBar">
            <li id="back" onclick="goBack();">
                <img src="res/img/back.png" />
                <p>Retour</p>
            </li>
            <li id="next"	onclick="goNext();">
                <p>Continuer</p>
                <img src="res/img/forward.png" />
            </li>
        </ul>

        <?php include('res/php/bgimg-selector.php'); ?>
        <?php include('res/php/color-selector.php'); ?>
		
        <div class="panel"><?php include("res/php/search-engines.php"); ?></div> <!-- Liste des moteurs de recherche -->
    </body>
</html>