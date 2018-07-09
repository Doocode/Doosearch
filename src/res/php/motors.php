<div class="quitListMotors" onclick="showMotors();"></div>
    <div class="listMotors">
    <div class="titleBar">
        <div class="left">
            <img src="res/img/back.png" onclick="showMotors();" />
            <h4>Moteurs de recherche</h4>
        </div>
        <div class="right">
            <img src="res/img/find.png" onclick="$('#findEngine').slideToggle();" />
        </div>
    </div>
        
    <input id="findEngine" type="text" placeholder="Rechercher un moteur de recherche" />
        
    <ul></ul>
</div>

<div class="central" onclick="hideMenuEngine();">
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
            <li id="actPinEngine" onclick="needToPinMotor = true; needToAddSelectedMotor=false; setSearchEngine(currentContextEngine);">
                <img src="res/img/pin.png" />
                <p>Epingler ce moteur</p>
            </li>
        </ul>
    </div>
</div>


<?php
    include('db.inc'); // On se connecte à la BDD
    $sql = "SELECT * FROM `searchengine` ORDER BY `title` ASC";
    $requete = $bdd->prepare($sql);
    $requete->execute();
    while ($donnees = $requete->fetch())
    { 
        ?>
            <script>
                (function() {
                    let item = new SearchEngine('<?= $donnees['title']; ?>', 'res/img/motors/<?= $donnees['icon']; ?>', '<?= $donnees['prefix']; ?>', '<?= $donnees['suffix']; ?>');
                    listSearchEngines.push(item);
                })();
            </script>
        <?php
    }
?>