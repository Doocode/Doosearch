<?php 
include("res/php/core.php"); 
$lang->setSection('setup');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/setup.css" />
        <?php $lang->setSection('setup'); ?>
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('first_steps'); ?></title>
        <script src="res/js/setup.js.php"></script>
        <script src="res/js/color-selector.js.php"></script>
        <script src="res/js/convert.js"></script>
        <script src="res/js/floating-buttons.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        
        <?php $lang->setSection('setup'); ?>
        
        <ul class="pagination">
            <li class="active" id="intro">
                <p><?= $lang->getKey('introduction'); ?></p>
                <ul class="slides"></ul>
            </li>
            <li id="customize">
                <p><?= $lang->getKey('customize'); ?></p>
                <ul class="slides"></ul>
            </li>
            <li id="ending">
                <p><?= $lang->getKey('ending'); ?></p>
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
                <p><?= $lang->getKey('go_back'); ?></p>
            </li>
            <li id="next"	onclick="goNext();">
                <p><?= $lang->getKey('continue'); ?></p>
                <img src="res/img/forward.png" />
            </li>
        </ul>

        <?php include('res/php/bgimg-selector.php'); ?>
        <?php include('res/php/color-selector.php'); ?>
		
        <div class="panel"><?php include("res/php/search-engines.php"); ?></div> <!-- Liste des moteurs de recherche -->
    </body>
</html>