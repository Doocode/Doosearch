<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php include("res/php/head-hub.php"); ?>
        <?php include("res/php/head-search-engines.php"); ?>
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/config.css" />
		<title>Doosearch > Configuration</title>
        <script src="res/js/color-selector.js"></script>
        <script src="res/js/convert.js"></script>
		<script src="res/js/config.js"></script>
    </head>

    <body onresize="resizeEvent();" onscroll="scrollEvent();">
        <?php include("res/php/header.php"); ?>
		
		<div class="page">			
			<ul class="navig">
				<h3>Configuration</h3>
				<li><a href="#1" onclick="showCtn(true);">Apparence</a></li>
				<li><a href="#2" onclick="showCtn(true);">Moteur de recherche par défaut</a></li>
				<li><a href="#3" onclick="showCtn(true);">Moteurs de recherche favoris</a></li>
				<li><a href="#4" onclick="showCtn(true);">Sites épinglés</a></li>
				<li><a href="#5" onclick="showCtn(true);">Options</a></li>
				<li><a href="#6" onclick="showCtn(true);">Remise à zéro</a></li>
				<div>
					<hr />
					<li><a href="search.php">Retour à l'accueil</a></li>
					<li><a href="#">Remonter en haut</a></li>
				</div>
			</ul>
			
			<div class="ctn">
				
				<article id="1">
					<h3>Apparence</h3>
					
					<table style="border-collapse: collapse; margin-right: 15px;">
						<tr>
							<td><h4>Image de fond</h4></td>
							<td><h4>Couleur d'arrière plan</h4></td>
							<td><h4>Couleur d'accentuation</h4></td>
						</tr>
						<tr>
							<td data-label="Image de fond">
								<div class="preview" id="previewBgImg">
									<input type="button" onclick="showEditor('#editBgImg');"/>
								</div>
							</td>
							<td data-label="Couleur d'arrière plan">
								<div class="preview" id="previewBgForm">
									<input type="button" onclick="showColorSelector('background');"/>
								</div>
							</td>
							<td data-label="Couleur d'accentuation">
								<div class="preview" id="previewBgList">
									<input type="button" onclick="showColorSelector('accent');" />
								</div>
							</td>
						</tr>
					</table>
				</article>
			
				<article id="2">
					<h3>Moteur de recherche par défaut</h3>
					<div class="selectMotor" onclick="showMotors();">
						<img src="res/img/choose.png" />
						<div>
							<h4>Nom du moteur de recherche</h4>
							<p>http://re.cherche/s?q=<span>votre recherche</span></p>
						</div>
					</div>
				</article>
			
				<article id="3">
					<h3>Moteurs de recherche favoris</h3>
					<ul class="pinned">
						<!-- Pour que le code JS puisse ajouter les moteurs épinglés APRES cet item CACHé -->
						<li style="display: none;">
							<img src="res/img/choose.png" />
							<p>Lorem ipsum</p>
						</li>
					</ul>
				</article>
			
				<article id="4">
					<h3>Sites épinglés</h3>
					<ul class="pinned">
						<!-- Pour que le code JS puisse ajouter les sites épinglés APRES cet item CACHé -->
						<li style="display: none;">
							<img src="res/img/choose.png" />
							<p>Lorem ipsum</p>
						</li>
					</ul>
				</article>
				
				<article id="5">
					<h3>Options</h3>
					
					<table id="displayTbl" style="border-collapse: collapse; margin-right: 15px;">
						<tr>
							<td><h4>Format des moteurs de recherche</h4></td>
							<td><h4>Lancer la recherche dans</h4></td>
						</tr>
						<tr>
							<td data-label="Forme de la liste" style="padding: 10px 15px; padding-top: 0px;">
								<input type="radio" name="forme" id="icones" onchange="setViewMode('forme');" /> 
                                <label for="icones">
                                    <img src="res/img/icons.png" />
                                    <span>Icônes</span>
                                </label>
								<input type="radio" name="forme" id="liste" onchange="setViewMode('forme');" /> 
                                <label for="liste">
                                    <img src="res/img/list.png" />
                                    <span>Liste</span>
                                </label>
							</td>
							<td data-label="Lancer la recherche dans" style="padding: 10px 15px; padding-top: 0px;">
								<input type="radio" name="lancementRecherche" id="currentTab" onchange="setViewMode('lancementRecherche');" /> 
                                <label for="currentTab">
                                    <img src="res/img/current-tab.png" />
                                    <span>L'onglet actuel</span>
                                </label>
								<input type="radio" name="lancementRecherche" id="newTab" onchange="setViewMode('lancementRecherche');" /> 
                                <label for="newTab">
                                    <img src="res/img/new-tab.png" />
                                    <span>Un nouvel onglet</span>
                                </label>
							</td>
						</tr>
					</table>
				</article>
				
				<article id="6">
					<h3>Remise à zéro</h3>
					<p>Pour tout effacer, le moteur de recherche par défaut et la couleur de fond, cliquez sur le bouton suivant : </p>
					<input type="reset" onclick="reset();" value="Remise à zéro" />
				</article>
			
			</div>
		</div>
            
        <div id="popups">
            <?php include('res/php/color-selector.php'); ?>
            <?php include('res/php/bgimg-selector.php'); ?>
        </div>

        <div class="saveBar">
            <p>Les paramètres modifiés sont automatiquement sauvegardés</p>
        </div>
		
		<div class="panel"><?php include("res/php/motors.php"); ?></div>
		
    </body>
</html>