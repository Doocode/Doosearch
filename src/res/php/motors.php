<div class="quitListMotors" onclick="showMotors();"></div>
    <div class="listMotors">
    <h4>Tous les moteurs de recherches disponibles</h4>
    <ul>
        <li onclick="setMotor('','','res/img/choose.png','');">
            <img src="res/img/choose.png" />
            <p>Demander plus tard</p>
        </li>
        <?php
        include('db.inc'); // On se connecte à la BDD
        $sql = "SELECT * FROM `searchengine` ORDER BY `title` ASC";
        $requete = $bdd->prepare($sql);
        $requete->execute();
        while ($donnees = $requete->fetch())
        {
            ?>
        <li onclick="setSearchEngine('<?= $donnees['title']; ?>','res/img/motors/<?= $donnees['icon']; ?>','<?= $donnees['prefix']; ?>','<?= $donnees['suffix']; ?>');">
            <img src="res/img/motors/<?= $donnees['icon']; ?>" />
            <p><?= $donnees['title']; ?></p>
        </li>
            <?php
        }
        ?>
    </ul>
</div>