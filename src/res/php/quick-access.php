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
			<p class="text">Pour ajouter un site web, completez le formulaire suivant :</p>
			
            <table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th>Icône</th>
                    <td><input type="text" name="icon" placeholder="Icône du site" /></td>
                </tr>
                <tr>
                    <th>Titre</th>
                    <td><input type="text" name="title" placeholder="Nom du site" /></td>
                </tr>
                <tr>
                    <th>Adresse URL</th>
                    <td><input type="text" name="url" placeholder="Tapez l'adresse du site" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="Ajouter" onclick="addWebsite();"/></td>
                </tr>
            </table>
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
			<table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th>Icône</th>
                    <td><input type="text" name="icon" placeholder="Icône du site" /></td>
                </tr>
                <tr>
                    <th>Titre</th>
                    <td><input type="text" name="title" placeholder="Nom du site" /></td>
                </tr>
                <tr>
                    <th>Adresse URL</th>
                    <td><input type="text" name="url" placeholder="Tapez l'adresse du site" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="Modifier" onclick="saveChanges();"/></td>
                </tr>
            </table>
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
            <li id="actEdit" onclick="editWebsite();">
                <img src="res/img/add2.png" />
                <p>Modifier ce lien</p>
            </li>
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