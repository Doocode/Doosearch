<?php

// src/res/core/Admin/SearchEngine.php

namespace Admin;
use Language\Lang;

class SearchEngine
{
    public static function find($id)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT id, title, icon, prefix, suffix, status
                FROM `$table`
                WHERE id = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        
        // Fetching data
        $data = $req->fetch();
        $req->closeCursor();
        
        return $data;
    }
    
    public static function getList($limit, $offset)
    {
        // Check if arguments are correct
        if(!is_int($limit) || !isset($limit))
            $limit = 20;
        if(!is_int($offset) || !isset($offset))
            $offset = 0;
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT id, title, icon, prefix, suffix, status
                FROM `$table`
                ORDER BY title
                LIMIT $limit
                OFFSET $offset";
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
    
    public static function getSize()
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT COUNT(*) as 'size'
                FROM `$table`";
        $req = $bdd->prepare($sql);
        $req->execute();
        $data = $req->fetch();
        $req->closeCursor();
        return $data['size'];
    }
    
    public static function execute($action, $args)
    {
        if($action=='update')
            return self::update($args['id'],$args['name'],$args['icon'],$args['prefix'],$args['suffix']);
        if($action=='add')
            return self::create($args['name'],$args['icon'],$args['prefix'],$args['suffix']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $title, $icon, $prefix, $suffix)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['search_engines'];
        $sql = "UPDATE `$table`
                SET `title` = ?, `icon` = ?, `prefix` = ?, `suffix` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($title, $icon, $prefix, $suffix, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_search_engines');
        $status = array('success' => Lang::getText('search_engine_updated_successfully', 
                                                  array('search_engine' => $title)));
        return $status;
    }
    
    public static function create($title, $icon, $prefix, $suffix)
    {
        // Login to database
        require('res/php/db.php');

        // Insert data
        $table = $tables['search_engines'];
        $sql = "INSERT INTO `$table`
                (`id`, `title`, `icon`, `prefix`, `suffix`, `status`)
                VALUES (NULL, ?, ?, ?, ?, 'enabled')";
        $req = $bdd->prepare($sql);
        $req->execute(array($title, $icon, $prefix, $suffix));
        $req->closeCursor();
        
        Lang::setModule('admin_search_engines');
        $status = array('success' => Lang::getText('search_engine_added_successfully'));
        return $status;
    }
    
    public static function remove($id)
    {
        // Login to database
        require('res/php/db.php');

        // Remove row
        $table = $tables['search_engines'];
        $sql = "DELETE FROM `$table`
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $req->closeCursor();
        
        Lang::setModule('admin_search_engines');
        $status = array('success' => Lang::getText('search_engine_removed_successfully'));
        return $status;
    }
    
    public static function toggleStatus($id)
    {
        // Get current status
        $engine = self::find($id);
        $nextState = 'disabled';
        if($engine['status'] == 'disabled')
            $nextState = 'enabled';
        
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['search_engines'];
        $sql = "UPDATE `$table`
                SET `status` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($nextState, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_search_engines');
        $status = array('success' => Lang::getText('search_engine_new_state_successfully', 
                                                  array('search_engine' => $engine['title'],
                                                        'new_status' => strtolower(Lang::getText($nextState)))));
        return $status;
    }
}