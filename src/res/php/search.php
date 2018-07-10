<div class="content">
	<ul class="selectedMotors"></ul> <!-- Liste des moteurs séléctionné : pour la recherche groupé -->
	
    <br />
    
	<div id="form">
		<input type="text" id="field" name="q" placeholder="Tapez votre recherche ici" onmouseover="showTooltip('Tapez ici votre recherche');" onmouseout="showTooltip('');" spellcheck="false" autofocus />
		<button id="clr" onclick="$('#field').val('');" onmouseover="showTooltip('Effacer la zone de recherche');" onmouseout="showTooltip('');"><img src="res/img/close.png" /></button>
		<button onclick="validateForm();" onmouseover="showTooltip('Lancer la recherche');" onmouseout="showTooltip('');"><img src="res/img/find.png" /></button>
	</div>
</div>