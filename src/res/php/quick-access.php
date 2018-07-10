<div id="addWebsite" class="winholder">
	<div class="closeArea" onclick="closeWindow('#addWebsite'); resetForm();">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title">Ajouter un site web</h1>
			<img src="res/img/close.png" onclick="closeWindow('#addWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<p style="max-width: 500px; margin-top: 0px;">Pour ajouter un site web, completer le formulaire suivant :</p>
			
			<div class="form">
				<div class="icon" onclick="alert('Bientôt');">
					<img src="res/img/choose.png" />
				</div>
				<div class="txt">
					<p><span>Titre : </span><input type="text" name="title" placeholder="Nom du site" /></p>
					<p><span>Adresse url : </span><input type="text" name="url" placeholder="Tapez l'adresse du site" /></p>
					<input type="button" value="Valider" onclick="addWebsite();"/>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="editWebsite" class="winholder">
	<div class="closeArea" onclick="closeWindow('#editWebsite'); resetForm();">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title">Modifier un raccourci</h1>
			<img src="res/img/close.png" onclick="closeWindow('#editWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<p style="max-width: 500px; margin-top: 0px;">Après modifications, cliquez sur le bouton "Valider" pour sauvegarder les modifications. Pour annuler les changements, cliquez à l'exterieur de cette boite de dialogue.</p>
			
			<div class="form">
				<div class="icon" onclick="alert('Bientôt');">
					<img src="res/img/choose.png" />
				</div>
				<div class="txt">
					<p><span>Titre : </span><input type="text" name="title" placeholder="Nom du site" /></p>
					<p><span>Adresse url : </span><input type="text" name="url" placeholder="Tapez l'adresse du site" /></p>
					<input type="button" value="Valider" onclick="alert('Bientôt')"/>
				</div>
			</div>
		</div>
	</div>
</div>