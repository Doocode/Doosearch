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