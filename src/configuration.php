<?php 
include("res/php/core.php"); 
$lang->setSection('configuration');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/config.css" />
        <?php $lang->setSection('configuration'); ?>
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('configuration'); ?></title>
        <script src="res/js/color-selector.js.php"></script>
        <script src="res/js/convert.js"></script>
		<script src="res/js/config.js.php"></script>
    </head>

    <body onresize="resizeEvent();" onscroll="scrollEvent();">
        <?php include("res/php/header.php"); ?>
        
        <?php $lang->setSection('configuration'); ?>
        
        <div id="titleBar">
            <img src="res/img/back.png" onclick="showArticle(false);" />
            <h2><?= $lang->getKey('configuration'); ?></h2>
        </div>
        
        <div id="filter"></div>
		
		<div class="page">			
			<ul class="navig">
				<h3><?= $lang->getKey('configuration'); ?></h3>
				<li><a href="#1" onclick="showArticle(true);"><?= $lang->getKey('appearence'); ?></a></li>
				<li><a href="#2" onclick="showArticle(true);"><?= $lang->getKey('default_search_engine'); ?></a></li>
				<li><a href="#3" onclick="showArticle(true);"><?= $lang->getKey('pinned_search_engines'); ?></a></li>
				<li><a href="#4" onclick="showArticle(true);"><?= $lang->getKey('pinned_websites'); ?></a></li>
				<li><a href="#5" onclick="showArticle(true);"><?= $lang->getKey('options'); ?></a></li>
				<li><a href="#6" onclick="showArticle(true);"><?= $lang->getKey('reset'); ?></a></li>
				<!--div>
					<hr />
					<li><a href="search.php">Retour à l'accueil</a></li>
					<li><a href="#">Remonter en haut</a></li>
				</div-->
			</ul>
			
			<div class="ctn">
				
				<article id="1">
					<h3><?= $lang->getKey('appearence'); ?></h3>
					
					<table id="tblCustomize">
						<tr>
							<th><?= $lang->getKey('background_image'); ?></th>
							<th><?= $lang->getKey('background_color'); ?></th>
							<th><?= $lang->getKey('accent_color'); ?></th>
						</tr>
						<tr class="inputs">
							<td data-label="<?= $lang->getKey('background_image'); ?>">
								<div class="preview" id="previewBgImg">
									<input type="button" onclick="showEditor('#editBgImg');"/>
								</div>
							</td>
							<td data-label="<?= $lang->getKey('background_color'); ?>">
								<div class="preview" id="previewBgForm">
									<input type="button" onclick="showColorSelector('background');"/>
								</div>
							</td>
							<td data-label="<?= $lang->getKey('accent_color'); ?>">
								<div class="preview" id="previewBgList">
									<input type="button" onclick="showColorSelector('accent');" />
								</div>
							</td>
						</tr>
					</table>
                    
                    <div id="filterSlider">
                        <p><?= $lang->getKey('filter_on_the_background'); ?></p>
                        <div class="slider">
                            <span><?= $lang->getKey('brighter'); ?></span>
                            <div class="color"><div class="gradient"><input type="range" min="-50" max="50" value="0" /></div></div>
                            <span><?= $lang->getKey('darker'); ?></span>
                        </div>
                        <button onclick="resetBgFilter()"><?= $lang->getKey('reset'); ?></button>
                    </div>
				</article>
			
				<article id="2">
					<h3><?= $lang->getKey('default_search_engine'); ?></h3>
					<div class="selectMotor" onclick="showMotors();">
						<img src="res/img/choose.png" />
						<div>
							<h4>Nom du moteur de recherche</h4>
							<p>http://re.cherche/s?q=<span>votre recherche</span></p>
						</div>
					</div>
				</article>
			
				<article id="3">
					<h3><?= $lang->getKey('pinned_search_engines'); ?></h3>
					<ul class="pinned">
						<!-- Pour que le code JS puisse ajouter les moteurs épinglés APRES cet item CACHé -->
						<li style="display: none;">
							<img src="res/img/choose.png" />
							<p>Lorem ipsum</p>
						</li>
					</ul>
				</article>
			
				<article id="4">
					<h3><?= $lang->getKey('pinned_websites'); ?></h3>
					<ul class="pinned" id="websites">
						<!-- Pour que le code JS puisse ajouter les sites épinglés APRES cet item CACHé -->
						<li style="display: none;">
							<img src="res/img/choose.png" />
							<p>Lorem ipsum</p>
						</li>
					</ul>
				</article>
				
				<article id="5">
					<h3><?= $lang->getKey('options'); ?></h3>
					
					<table id="tblOptions">
						<tr>
							<th><?= $lang->getKey('list_shape'); ?></th>
							<th><?= $lang->getKey('open_the_search_in'); ?></th>
						</tr>
						<tr class="inputs">
							<td data-label="<?= $lang->getKey('list_shape'); ?>">
								<input type="radio" name="forme" id="icones" onchange="setViewMode('forme');" /> 
                                <label for="icones">
                                    <img src="res/img/icons.png" />
                                    <span><?= $lang->getKey('icons'); ?></span>
                                </label>
								<input type="radio" name="forme" id="liste" onchange="setViewMode('forme');" /> 
                                <label for="liste">
                                    <img src="res/img/list.png" />
                                    <span><?= $lang->getKey('list'); ?></span>
                                </label>
							</td>
							<td data-label="<?= $lang->getKey('open_the_search_in'); ?>">
								<input type="radio" name="lancementRecherche" id="currentTab" onchange="setViewMode('lancementRecherche');" /> 
                                <label for="currentTab">
                                    <img src="res/img/current-tab.png" />
                                    <span><?= $lang->getKey('current_tab'); ?></span>
                                </label>
								<input type="radio" name="lancementRecherche" id="newTab" onchange="setViewMode('lancementRecherche');" /> 
                                <label for="newTab">
                                    <img src="res/img/new-tab.png" />
                                    <span><?= $lang->getKey('new_tab'); ?></span>
                                </label>
							</td>
						</tr>
						<tr>
							<th><?= $lang->getKey('interface_contrast'); ?></th>
							<th><?= $lang->getKey('transparent_background'); ?></th>
						</tr>
						<tr class="inputs">
							<td data-label="<?= $lang->getKey('interface_contrast'); ?>">
								<input type="radio" name="contrast" id="light" onchange="setViewMode('contrast');" /> 
                                <label for="light">
                                    <img src="res/img/light.png" />
                                    <span><?= $lang->getKey('brighter'); ?></span>
                                </label>
								<input type="radio" name="contrast" id="dark" onchange="setViewMode('contrast');" /> 
                                <label for="dark">
                                    <img src="res/img/dark.png" />
                                    <span><?= $lang->getKey('darker'); ?></span>
                                </label>
							</td>
							<td data-label="<?= $lang->getKey('transparent_background'); ?>">
								<input type="radio" name="transBG" id="enabled" onchange="setViewMode('transBG');" /> 
                                <label for="enabled">
                                    <img src="res/img/enable.png" />
                                    <span><?= $lang->getKey('enabled'); ?></span>
                                </label>
								<input type="radio" name="transBG" id="disabled" onchange="setViewMode('transBG');" /> 
                                <label for="disabled">
                                    <img src="res/img/disable.png" />
                                    <span><?= $lang->getKey('disabled'); ?></span>
                                </label>
							</td>
						</tr>
					</table>
				</article>
				
				<article id="6">
					<h3><?= $lang->getKey('reset'); ?></h3>
					<p><?= $lang->getKey('reset_text'); ?></p>
					<input type="reset" onclick="reset();" value="<?= $lang->getKey('reset'); ?>" />
				</article>
			
			</div>
		</div>
            
        <div id="popups">
            <?php include('res/php/color-selector.php'); ?>
            <?php include('res/php/bgimg-selector.php'); ?>
        </div>

        <div class="saveBar">
            <?php $lang->setSection('configuration'); ?>
            <p><?= $lang->getKey('settings_automatically_saved'); ?></p>
        </div>
		
		<div class="panel"><?php include("res/php/search-engines.php"); ?></div>
		
    </body>
</html>