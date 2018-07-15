<div class="closeListSearchEngines" onclick="showMotors();"></div>
<div class="popupSearchEngines">
    <div class="top">
        <div class="titleBar">
            <div class="left">
                <img src="res/img/back.png" onclick="showMotors();" />
                <h4>Moteurs de recherche</h4>
            </div>
            <div class="right">
                <img id="list" src="res/img/list2.png" onclick="showAsList(true);" title="Afficher sous forme de liste" />
                <img id="icons" src="res/img/icons2.png" onclick="showAsList(false);" title="Afficher sous forme d'icônes" />
                <img id="recherche" class="checked" src="res/img/find.png" onclick="toggleSearchBar();" title="Rechercher des moteurs" />
            </div>
        </div>

        <input id="findEngine" type="text" placeholder="Rechercher un moteur de recherche" />
    </div>
        
    <div class="center"><ul class="searchEngines"></ul></div>
</div>

<div class="central menu" onclick="hideMenuEngine();">
    <div class="aligner"></div>
    <div class="menuEngine">
        <div class="view">
            <img src="res/img/choose.png" />
            <h5>Lorem ipsum</h5>
        </div>
        <ul class="actions">
            <li id="actSetEngine" onclick="needToPinMotor=false; needToAddSelectedMotor=false; setSearchEngine(currentContextEngine);">
                <img src="res/img/use.png" />
                <p>Utiliser ce moteur</p>
            </li>
            <li id="actAddEngine" onclick="needToPinMotor=false; needToAddSelectedMotor=true; setSearchEngine(currentContextEngine);">
                <img src="res/img/add2.png" />
                <p>Ajouter ce moteur</p>
            </li>
            <li id="actRemoveEngine" onclick="removeSelectedEngine(currentContextEngine);">
                <img src="res/img/remove.png" />
                <p>Désélectionner ce moteur</p>
            </li>
            <li id="actPinEngine" onclick="needToPinMotor = true; needToAddSelectedMotor=false; setSearchEngine(currentContextEngine);">
                <img src="res/img/pin.png" />
                <p>Epingler ce moteur</p>
            </li>
            <li id="actUnpinEngine" onclick="removePinnedEngine(currentContextEngine);">
                <img src="res/img/remove.png" />
                <p>Désépingler ce moteur</p>
            </li>
        </ul>
    </div>
</div>