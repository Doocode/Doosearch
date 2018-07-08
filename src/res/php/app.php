<div id="appFind">
	<ul class="selectedMotors"></ul> <!-- Liste des moteurs séléctionné : pour la recherche groupé -->
	
    <br />
    
	<div id="form">
		<input type="text" id="field" name="q" placeholder="Tapez votre recherche ici" onmouseover="showTooltip('Tapez ici votre recherche');" onmouseout="showTooltip('');" spellcheck="false" autofocus />
		<button id="clr" onclick="$('#field').val('');" onmouseover="showTooltip('Effacer la zone de recherche');" onmouseout="showTooltip('');"><img src="res/img/close.png" /></button>
		<button onclick="validateForm();" onmouseover="showTooltip('Lancer la recherche');" onmouseout="showTooltip('');"><img src="res/img/find.png" /></button>
	</div>
	
	<ul class="toolBar">
		<li onclick="showMotors();" onmouseover="showTooltip('Changer de moteur de recherche');" onmouseout="showTooltip('');"><img src="res/img/menu2.png" /></li>
		<li	onclick="document.location.href='#speedDial';" onmouseover="showTooltip('Sites épinglés');" onmouseout="showTooltip('');"><img src="res/img/bookmarks.png" /></li>
		
		<div class="pinned">
		</div>
		<li	onclick="addPinnedMotors();" onmouseover="showTooltip('Epingler un moteur');" onmouseout="showTooltip('');"><img src="res/img/add.png" /></li>
		
		<p class="tooltip">Tooltip</p>
	</ul>
</div>