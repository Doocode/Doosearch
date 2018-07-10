<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/app-header.css" />
        <link rel="stylesheet" href="res/css/home.css" />
        <link rel="stylesheet" href="res/css/color-selector.css" />
        <link rel="stylesheet" href="res/css/config.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
		<title>Doosearch > Configuration</title>
        <script src="res/js/color-selector.js"></script>
        <script src="res/js/convert.js"></script>
		<script src="res/js/config.js"></script>
		<script src="res/js/motors.js"></script>
    </head>

    <body onresize="resizeEvent();" onscroll="scrollEvent();">
        <?php include("res/php/header.php"); ?>
		
		<script>
            /* Ne pas afficher cette page si les données sauvegardées ne sont à jour */
			if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.31)
				document.location.href='setup.php';
		</script>
		
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
								<div class="colorEditor" id="editBgImg">
									<div class="titleBar">
										<button onclick="showEditor('#editBgImg');"><img src="res/img/back.png" /></button>
										<p>Image de fond</p>
									</div>
									<ul class="tabs">
										<li class="current" id="tabDefaultImg" onclick="$('#editBgImg #defaultBgImg').slideDown(); $('#editBgImg #customBgImg').slideUp(); $('#tabDefaultImg').addClass('current'); $('#tabCustomImg').removeClass('current');">Fonds d'écran</li>
										<li id="tabCustomImg" onclick="$('#editBgImg #defaultBgImg').slideUp(); $('#editBgImg #customBgImg').slideDown(); $('#tabDefaultImg').removeClass('current'); $('#tabCustomImg').addClass('current');">Image personnalisée</li>
									</ul>
									<ul class="colorSelector" id="defaultBgImg">
										<li onclick="resetBgImg();" style="background-image: url(res/img/bgs/empty.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg1.png');" style="background-image: url(res/img/bgs/bg1.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg2.png');" style="background-image: url(res/img/bgs/bg2.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg3.png');" style="background-image: url(res/img/bgs/bg3.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg4.png');" style="background-image: url(res/img/bgs/bg4.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG30.png');" style="background-image: url(res/img/bgs/DCG30.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG29.png');" style="background-image: url(res/img/bgs/DCG29.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg6.png');" style="background-image: url(res/img/bgs/bg6.png);"></li>
										<br/>
										<li onclick="setBgImg('res/img/bgs/bg5.png');" style="background-image: url(res/img/bgs/bg5.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG28.png');" style="background-image: url(res/img/bgs/DCG28.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG27.png');" style="background-image: url(res/img/bgs/DCG27.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG25.png');" style="background-image: url(res/img/bgs/DCG25.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG24.png');" style="background-image: url(res/img/bgs/DCG24.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG23.png');" style="background-image: url(res/img/bgs/DCG23.png);"></li>
										<li onclick="setBgImg('res/img/bgs/DCG26.png');" style="background-image: url(res/img/bgs/DCG26.png);"></li>
										<li onclick="setBgImg('res/img/bgs/bg7.png');" style="background-image: url(res/img/bgs/bg7.png);"></li>
									</ul>
									<ul class="colorSelector" id="customBgImg">
										<li id="btnImportImg" onclick="importImage();" style="background-image: url(res/img/bgs/import.png);"></li>
									</ul>
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
        </div>

        <div class="saveBar">
            <p>Les paramètres modifiés sont automatiquement sauvegardés</p>
        </div>
		
		<div class="panel"><?php include("res/php/motors.php"); ?></div>
		
    </body>
</html>