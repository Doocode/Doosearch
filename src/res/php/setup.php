<div class="screen" id="screen1">
	<img src="res/img/white-flat-logo.png" id="logo" />
	<h1>Bienvenue</h1>
	<p>Bienvenue sur Doosearch, votre future page d'accueil. Cette page va vous guider dans la configuration de Doosearch à travers différentes étapes listées ci-dessous.<!-- Si vous préférez configurer avec les paramètres par défaut, cliquez sur « Ignorer ».--></p>
	
	<ul id="steps">
		<li>Introduction à Doosearch</li>
		<li>Moteur de recherche par défaut</li>
		<li>Personnalisation de l'interface</li>
	</ul>
    
    <div class="buttons">
        <input type="button" onclick="skipIntro();" value="Passer à la configuration"/>
        <input type="button" onclick="saveSettings();" class="ignore" value="Sauter les étapes"/>
    </div>
</div>

<div class="screen" id="screen2">
	<h1>Voici votre page d'accueil</h1>
	<p>Doosearch est une page web propose en une page d'accueil un formulaire de recherche avec la possibilité de lancer une recherche vers plus de 100 sites web différents (dont Google, Bing, DuckDuckGo et Qwant).</p>
	
	<img src="res/img/screens/1.png" onclick="viewScreen('res/img/screens/1.png');" class="screenImg" />
	<img src="res/img/screens/1m.png" class="screenImgMobile" />
</div>

<div class="screen" id="screen3">
	<h1>Sélectioner un moteur de recherche</h1>
	<p>Pour sélectioner un moteur de recherche, cliquez sur le bouton menu en bas de l'écran et la liste des moteurs disponible apparaitra.</p>
	
	<img src="res/img/screens/2.gif" onclick="viewScreen('res/img/screens/2.png');" class="screenImg" />
	<img src="res/img/screens/2m.png" class="screenImgMobile" />
</div>

<div class="screen" id="screen4">
	<h1>Accès rapide</h1>
	<p>Pour accéder rapidement aux moteurs que vous utilisez souvent, vous pouvez épingler vos moteurs préférés via un clic droit sur les moteurs de recherche.</p>
	
	<img src="res/img/screens/3.gif" onclick="viewScreen('res/img/screens/3.png');" class="screenImg" />
	<img src="res/img/screens/3m.png" class="screenImgMobile" />
</div>

<div class="screen" id="screen5">
	<h1>Moteur de recherche par défaut</h1>
	<p>Sélectionnez un moteur de recherche pour le définir par défaut, ainsi à chaque utilisation de Doosearch, vous retrouverez le moteur sélectionné</p>
	
	<ul class="rects">
		<li id="imgMotor">
			<p>Moteur de recherche</p>
			<div onclick="showMotors();" style="background: url(res/img/choose.png) no-repeat center center / cover;"><span>Aucun</span></div>
		</li>
	</ul>
</div>

<div class="screen" id="screen6">
	<h1>Personnalisation de l'interface</h1>
	<p>Maintenant, faites participer votre créativité et sélectionnez les couleurs qui vont ensemble afin de rendre la page d'accueil plus en accord avec votre personnalité. Vous pouvez également choisir une image de fond.</p>
	
	<ul class="rects">
		<li id="bgColor">
			<p>Couleur de l'arrière plan</p>
			<div onclick="showColorSelector('background');" id="backgroundColor"></div>
		</li>
		<li id="bgImg">
			<p>Image d'arrière plan</p>
			<div onclick="showEditor('#editBgImg');" id="backgroundImage"></div>
		</li>
		<li id="bgColor2">
			<p>Couleur d'accentuation</p>
			<div onclick="showColorSelector('accent');" id="accentColor"></div>
		</li>
	</ul>
</div>
