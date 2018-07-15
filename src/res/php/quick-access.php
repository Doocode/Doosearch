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
				<div class="icon" onclick="getIconUrl();">
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
				<div class="icon" onclick="getIconUrl();">
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

<div class="central ctxtmenu" onclick="hideMenu();">
    <div class="aligner"></div>
    <div class="menu">
        <div class="view">
            <img src="res/img/choose.png" />
            <h5>Lorem ipsum</h5>
        </div>
        <ul class="actions">
            <li id="actOpen" onclick="openLink();">
                <img src="res/img/use.png" />
                <p>Ouvrir ce lien</p>
            </li>
            <!--li id="actEdit" onclick="alert('Modifier ce lien');">
                <img src="res/img/add2.png" />
                <p>Modifier ce lien</p>
            </li-->
            <li id="actDuplicate" onclick="duplicateWebsite();">
                <img src="res/img/add2.png" />
                <p>Dupliquer ce lien</p>
            </li>
            <li id="actRemove" onclick="removeWebsite();">
                <img src="res/img/remove.png" />
                <p>Supprimer ce lien</p>
            </li>
        </ul>
    </div>
</div>