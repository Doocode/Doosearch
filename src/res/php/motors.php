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
        <li onclick="setMotor('<?php echo $donnees['prefix']; ?>','<?php echo $donnees['suffix']; ?>','res/img/motors/<?php echo $donnees['icon']; ?>','<?php echo $donnees['title']; ?>');">
            <img src="res/img/motors/<?php echo $donnees['icon']; ?>" />
            <p><?php echo $donnees['title']; ?></p>
        </li>
            <?php
        }
        ?>
    </ul>
</div>