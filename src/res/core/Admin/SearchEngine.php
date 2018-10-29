<?php

// src/res/core/Admin/SearchEngine.php

namespace Admin;
use Language\Lang;

class SearchEngine
{
    public static function getList()
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT id, title, icon, prefix, suffix
                FROM `$table`
                ORDER BY title";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        $list = array();
        while($data = $req->fetch())
        {
            $list[] = $data;
        }
        $req->closeCursor();
        
        return $list;
    }
}
