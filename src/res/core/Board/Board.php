<?php

// src/res/core/Board/Board.php

namespace Board;
use Language\Lang;

class Board
{
    public static function getActions($type, $isEnabled)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $enabled = 0;
        if($isEnabled)
            $enabled = 1;
        $table = $tables['board'];
        $sql = "SELECT name, url, icon
                FROM `$table`
                WHERE type = ?
                AND enabled = ?
                ORDER BY name";
        $req = $bdd->prepare($sql);
        $req->execute(array($type, $enabled));
        
        // Fetching data
        $userExists = false;
        while($data = $req->fetch())
        {
            ?>
                <li>
                    <a href="<?= $data['url'] ?>">
                        <img src="res/img/<?= $data['icon'] ?>" />
                        <p><?= Lang::getKey($data['name']); ?></p>
                    </a>
                </li>
            <?php
        }
        $req->closeCursor();
    }
}