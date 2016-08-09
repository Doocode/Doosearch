<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0">
        <link rel="stylesheet" href="res/css/animate.css" />
        <link rel="stylesheet" href="res/css/main.css" />
        <link rel="stylesheet" href="res/css/header.css" />
        <link rel="stylesheet" href="res/css/config.css" />
        <link rel="stylesheet" href="res/css/list-motors.css" />
		<link rel="icon" type="image/png" href="res/img/favicon.png" />
		<title>Doosearch > Configuration</title>
    </head>

    <body onresize="resizeEvent();" onscroll="scrollEvent();">
        <?php include("res/php/header.php"); ?>
		
		<script>
			if (localStorage['doosearchVersion'] == null || localStorage['doosearchVersion'] < 1.31)
				document.location.href='index.php';
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
					<li><a href="home.php">Retour à l'accueil</a></li>
					<li><a href="#">Remonter en haut</a></li>
				</div>
			</ul>
			
			<div class="ctn">
				
				<article id="1">
					<h3>Apparence</h3>
					
					<table style="border-collapse: collapse; margin-right: 15px;">
						<tr>
							<td><h4>Image de fond</h4></td>
							<td><h4>La page d'accueil</h4></td>
							<td><h4>La liste des moteurs</h4></td>
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
							<td data-label="La page d'accueil">
								<div class="preview" id="previewBgForm">
									<input type="button" onclick="showEditor('#editBgForm');"/>
								</div>
								<div class="colorEditor" id="editBgForm">
									<div class="titleBar">
										<button onclick="showEditor('#editBgForm');"><img src="res/img/back.png" /></button>
										<p>La page d'accueil</p>
									</div>
									<ul class="tabs">
										<li class="current" onclick="$('#editBgForm .colorSelector').css('display','block'); $('#editBgForm .customiseColor').css('display','none');">Couleurs prédéfinies</li>
										<li onclick="/*$('#editBgForm .colorSelector').css('display','none'); $('#editBgForm .customiseColor').css('display','block');*/ alert('Désactivé pour le moment');">Couleur personnalisée</li>
									</ul>
									<ul class="colorSelector">
										<li onclick="setColor('bgForm','#EF2929');" style="background: #EF2929;"></li>
										<li onclick="setColor('bgForm','#FCAF3E');" style="background: #FCAF3E;"></li>
										<li onclick="setColor('bgForm','#E9B96E');" style="background: #E9B96E;"></li>
										<li onclick="setColor('bgForm','#FCE94F');" style="background: #FCE94F;"></li>
										<li onclick="setColor('bgForm','#8AE234');" style="background: #8AE234;"></li>
										<li onclick="setColor('bgForm','#729FCF');" style="background: #729FCF;"></li>
										<li onclick="setColor('bgForm','#AD7FA8');" style="background: #AD7FA8;"></li>
										<li onclick="setColor('bgForm','#888A85');" style="background: #888A85;"></li>
										<br />
										<li onclick="setColor('bgForm','#CC0000');" style="background: #CC0000;"></li>
										<li onclick="setColor('bgForm','#F57900');" style="background: #F57900;"></li>
										<li onclick="setColor('bgForm','#C17D11');" style="background: #C17D11;"></li>
										<li onclick="setColor('bgForm','#EDD400');" style="background: #EDD400;"></li>
										<li onclick="setColor('bgForm','#73D216');" style="background: #73D216;"></li>
										<li onclick="setColor('bgForm','#3465A4');" style="background: #3465A4;"></li>
										<li onclick="setColor('bgForm','#75507B');" style="background: #75507B;"></li>
										<li onclick="setColor('bgForm','#555753');" style="background: #555753;"></li>
										<br />
										<li onclick="setColor('bgForm','#A40000');" style="background: #A40000;"></li>
										<li onclick="setColor('bgForm','#CE5C00');" style="background: #CE5C00;"></li>
										<li onclick="setColor('bgForm','#8F5902');" style="background: #8F5902;"></li>
										<li onclick="setColor('bgForm','#C4A000');" style="background: #C4A000;"></li>
										<li onclick="setColor('bgForm','#4E9A06');" style="background: #4E9A06;"></li>
										<li onclick="setColor('bgForm','#204A87');" style="background: #204A87;"></li>
										<li onclick="setColor('bgForm','#5C3566');" style="background: #5C3566;"></li>
										<li onclick="setColor('bgForm','#2E3436');" style="background: #2E3436;"></li>
									</ul>
									<div class="customiseColor">
										<div class="viewer"><!--input type="color" /--></div>
										<div class="editor">
											<p class="red"><span>Rouge</span><input type="number" min="0" max="255" onchange="updateColor('bgForm');" onkeypress="updateColor('bgForm');"/></p>
											<p class="green"><span>Vert</span><input type="number" min="0" max="255" onchange="updateColor('bgForm');" onkeypress="updateColor('bgForm');"/></p>
											<p class="blue"><span>Bleu</span><input type="number" min="0" max="255" onchange="updateColor('bgForm');" onkeypress="updateColor('bgForm');"/></p>
										</div>
									</div>
								</div>
							</td>
							<td data-label="La liste des moteurs">
								<div class="preview" id="previewBgList">
									<input type="button" onclick="showEditor('#editBgList');" />
								</div>
								<div class="colorEditor" id="editBgList">
									<div class="titleBar">
										<button onclick="showEditor('#editBgList');"><img src="res/img/back.png" /></button>
										<p>La liste des moteurs</p>
									</div>
									<ul class="tabs">
										<li class="current" onclick="$('#editBgList .colorSelector').css('display','block'); $('#editBgList .customiseColor').css('display','none');">Couleurs prédéfinies</li>
										<li onclick="/*$('#editBgList .colorSelector').css('display','none'); $('#editBgList .customiseColor').css('display','block');*/ alert('Désactivé pour le moment');">Couleur personnalisée</li>
									</ul>
									<ul class="colorSelector">
										<li onclick="setColor('bgList','#EF2929');" style="background: #EF2929;"></li>
										<li onclick="setColor('bgList','#FCAF3E');" style="background: #FCAF3E;"></li>
										<li onclick="setColor('bgList','#E9B96E');" style="background: #E9B96E;"></li>
										<li onclick="setColor('bgList','#FCE94F');" style="background: #FCE94F;"></li>
										<li onclick="setColor('bgList','#8AE234');" style="background: #8AE234;"></li>
										<li onclick="setColor('bgList','#729FCF');" style="background: #729FCF;"></li>
										<li onclick="setColor('bgList','#AD7FA8');" style="background: #AD7FA8;"></li>
										<li onclick="setColor('bgList','#888A85');" style="background: #888A85;"></li>
										<br />
										<li onclick="setColor('bgList','#CC0000');" style="background: #CC0000;"></li>
										<li onclick="setColor('bgList','#F57900');" style="background: #F57900;"></li>
										<li onclick="setColor('bgList','#C17D11');" style="background: #C17D11;"></li>
										<li onclick="setColor('bgList','#EDD400');" style="background: #EDD400;"></li>
										<li onclick="setColor('bgList','#73D216');" style="background: #73D216;"></li>
										<li onclick="setColor('bgList','#3465A4');" style="background: #3465A4;"></li>
										<li onclick="setColor('bgList','#75507B');" style="background: #75507B;"></li>
										<li onclick="setColor('bgList','#555753');" style="background: #555753;"></li>
										<br />
										<li onclick="setColor('bgList','#A40000');" style="background: #A40000;"></li>
										<li onclick="setColor('bgList','#CE5C00');" style="background: #CE5C00;"></li>
										<li onclick="setColor('bgList','#8F5902');" style="background: #8F5902;"></li>
										<li onclick="setColor('bgList','#C4A000');" style="background: #C4A000;"></li>
										<li onclick="setColor('bgList','#4E9A06');" style="background: #4E9A06;"></li>
										<li onclick="setColor('bgList','#204A87');" style="background: #204A87;"></li>
										<li onclick="setColor('bgList','#5C3566');" style="background: #5C3566;"></li>
										<li onclick="setColor('bgList','#2E3436');" style="background: #2E3436;"></li>
									</ul>
									<div class="customiseColor">
										<div class="viewer"></div>
										<div class="editor">
											<p class="red"><span>Rouge</span><input type="number" min="0" max="255" onchange="updateColor('bgList');" onkeypress="updateColor('bgList');"/></p>
											<p class="green"><span>Vert</span><input type="number" min="0" max="255" onchange="updateColor('bgList');" onkeypress="updateColor('bgList');"/></p>
											<p class="blue"><span>Bleu</span><input type="number" min="0" max="255" onchange="updateColor('bgList');" onkeypress="updateColor('bgList');"/></p>
										</div>
									</div>
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
							<td><h4>Affichage de la liste</h4></td>
							<td><h4>Forme de la liste</h4></td>
						</tr>
						<tr>
							<td data-label="Affichage de la liste" style="padding: 10px 15px; padding-top: 0px;">
								<input type="radio" name="taille" id="sideScreen" onchange="setViewMode('taille');" /> <label for="sideScreen"><img src="res/img/side.png" />Sur le côté</label>
								<input type="radio" name="taille" id="fullScreen" onchange="setViewMode('taille');" /> <label for="fullScreen"><img src="res/img/full-screen.png" />Plein écran</label>
							</td>
							<td data-label="Forme de la liste" style="padding: 10px 15px; padding-top: 0px;">
								<input type="radio" name="forme" id="icones" onchange="setViewMode('forme');" /> <label for="icones"><img src="res/img/icons.png" />Icônes</label>
								<input type="radio" name="forme" id="liste" onchange="setViewMode('forme');" /> <label for="liste"><img src="res/img/list.png" />Liste</label>
							</td>
						</tr>
						
						<tr>
							<td><h4>Lancer la recherche dans</h4></td>
						</tr>
						<tr>
							<td data-label="Lancer la recherche dans" style="padding: 10px 15px; padding-top: 0px;">
								<input type="radio" name="lancementRecherche" id="currentTab" onchange="setViewMode('lancementRecherche');" /> <label for="currentTab"><img src="res/img/current-tab.png" />L'onglet actuel</label>
								<input type="radio" name="lancementRecherche" id="newTab" onchange="setViewMode('lancementRecherche');" /> <label for="newTab"><img src="res/img/new-tab.png" />Un nouvel onglet</label>
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
		
			<div class="saveBar">
				<p>Les paramètres modifiés sont automatiquement sauvegardés</p>
			</div>
		</div>
		
		<div class="panel"><?php include("res/php/motors.php"); ?></div>
		
		<script src="res/js/config.js"></script>	
		<!--<script src="res/js/speeddial.js"></script>	-->	
    </body>
</html>