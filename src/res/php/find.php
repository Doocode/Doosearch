<div id="appFind">
	<div >
		<img class="logo" onclick="showMotors();" src="res/img/choose.png" onmouseover="showTooltip('Changer de moteur de recherche');" onmouseout="showTooltip('');"/>
		<!--<img class="logo" onclick="showMotors();" src="res/img/choose.png" onmouseover="showTooltip('Changer de moteur de recherche');" onmouseout="showTooltip('');"/>-->
	</div>
	
	<div id="form">
		<input type="text" id="field" name="q" placeholder="Tapez votre recherche ici" onmouseover="showTooltip('Tapez ici votre recherche');" onmouseout="showTooltip('');" spellcheck="false" autofocus />
		<button id="clr" onclick="$('#field').val('');" onmouseover="showTooltip('Effacer la zone de recherche');" onmouseout="showTooltip('');"><img src="res/img/close.png" /></button>
		<button onclick="validateForm();" onmouseover="showTooltip('Lancer la recherche');" onmouseout="showTooltip('');"><img src="res/img/find.png" /></button>
	</div>
	
	<ul class="toolBar">
		<li onclick="showMotors();" onmouseover="showTooltip('Changer de moteur de recherche');" onmouseout="showTooltip('');"><img src="res/img/menu2.png" /></li>
		<li	onclick="document.location.href='configuration.php';" onmouseover="showTooltip('Configuration');" onmouseout="showTooltip('');"><img src="res/img/config-icon.png" /></li>
		<li	onclick="document.location.href='#speedDial';" onmouseover="showTooltip('Sites épinglés');" onmouseout="showTooltip('');"><img src="res/img/bookmarks.png" /></li>
		
		<div class="pinned">
			<li	style="display: none;" onmouseover="showTooltip('Twitter');" onmouseout="showTooltip('');"><img src="res/img/motors/twitter.png" /></li>
			<li	style="display: none;" onmouseover="showTooltip('Windows Store');" onmouseout="showTooltip('');"><img src="res/img/motors/windowsstore.png" /></li>
			<li	style="display: none;" onmouseover="showTooltip('Boulanger');" onmouseout="showTooltip('');"><img src="res/img/motors/new/boulanger.jpg" /></li>
		</div>
		<li	onclick="addPinnedMotors();" onmouseover="showTooltip('Epingler un moteur');" onmouseout="showTooltip('');"><img src="res/img/add.png" /></li>
		
		<p class="tooltip">Tooltip</p>
	</ul>
	
	<div class="clock" onclick="showTime();">
		<div class="full"></div>
		<div class="ctn">
			<h1>00:00</h1>
			<p id="date">Lundi 1er Janvier 1917</p>
			
			<p class="pub">Voyagez dans le temps avec Doochronos</p>
		</div>
	</div>
</div>