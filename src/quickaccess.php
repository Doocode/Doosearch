<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setModule('quick_access');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php");
        include("res/php/head-hub.php"); ?>
        <link rel="stylesheet" href="res/css/toolbar.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/quick-access.css" />
        <link rel="stylesheet" href="res/css/quick-access-popup.css" />
        <link rel="stylesheet" href="res/css/menu.css" />
        <?php Lang::setModule('quick_access'); ?>
        <title><?= $_APP['app_name'] .' > '. Lang::getText('quick_access'); ?></title>
		<script src="res/js/windows.js"></script>
		<script src="res/js/quick-access.js"></script>
        <script src="res/js/floating-buttons.js"></script>
    </head>

    <body>
        <?php 
			include("res/php/header.php");
			include("res/views/hub/background.php");
		
			Lang::setModule('quick_access');
		?>
		
		<div class="central">
			<div class="aligner"></div>
			<div class="content">
                <div id="searchBar"><input type="text" placeholder="<?= Lang::getText('search'); ?>" onmouseover="showTooltip('<?= Lang::getText('search_a_pinned_website'); ?>');" spellcheck="false" autofocus /></div>
                <ul class="tiles"></ul>
			</div>
	
		</div>
	
        <ul class="toolBar">
            <li onclick="popupAddWebsite()" onmouseover="showTooltip('<?= Lang::getText('add_a_website'); ?>');"><img src="res/img/add.png" /></li>
            <li onclick="$('#searchBar').slideToggle(); $('#searchBar input').val(''); updateView();" onmouseover="showTooltip('<?= Lang::getText('search_a_pinned_website'); ?>');"><img src="res/img/find.png" /></li>
            
            <p class="tooltip">Tooltip</p>
        </ul>
        
        <?php include('res/php/quick-access.php'); ?>
    </body>
</html>