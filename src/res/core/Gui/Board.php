<?php

// src/res/core/Gui/Board.php

namespace Gui;
use Language\Lang;

class Board
{
    public static function getActions($type, $isEnabled)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $status = 'disabled';
        if($isEnabled)
            $status = 'enabled';
        $table = $tables['board'];
        $sql = "SELECT keyword, url, icon
                FROM `$table`
                WHERE type = ?
                AND status = ?
                ORDER BY keyword";
        $req = $bdd->prepare($sql);
        $req->execute(array($type, $status));
        
        // Fetching data
        Lang::setModule('board');
        while($data = $req->fetch())
        {
            ?>
                <li>
                    <a href="<?= $data['url'] ?>">
                        <img src="res/img/board/<?= $data['icon'] ?>" />
                        <p><?= Lang::getText($data['keyword']); ?></p>
                    </a>
                </li>
            <?php
        }
        $req->closeCursor();
    }
}