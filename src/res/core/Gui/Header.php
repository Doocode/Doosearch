<?php

// src/res/core/Gui/Header

namespace Gui;
use Language\Lang;

class Header
{
    public static function getPages()
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['pages'];
        $sql = "SELECT keyword, url
                FROM `$table`
                WHERE status = ?
                ORDER BY priority";
        $req = $bdd->prepare($sql);
        $req->execute(array('enabled'));
        
        // Fetching data
        Lang::setModule('header');
        $pages = array();
        while($data = $req->fetch())
        {
            $data['name'] = Lang::getText($data['keyword']);
            $pages[] = $data;
        }
        $req->closeCursor();
        
        return $pages;
    }
}