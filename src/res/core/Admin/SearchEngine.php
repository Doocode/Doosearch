<?php

// src/res/core/Admin/SearchEngine.php

namespace Admin;
use Language\Lang;
use Admin\Category;

class SearchEngine extends Administration
{
    private static $TITLE = 'title';
    private static $STATUS = 'status';
    
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
        
        // Get categories
        $data['categories'] = self::getCategoriesFor($id);
        
        return $data;
    }
    
    public static function getList($limit, $offset, $orderBy)
    {
        // Check if arguments are correct
        /*if(!is_int($limit))
            $limit = 20;
        if(!is_int($offset))
            $offset = 0;*/
        switch($orderBy['orderBy'])
        {
            case self::$TITLE:
            case self::$STATUS:
                break;
            default:
                $orderBy = self::$TITLE;
                break;
        }
        if($orderBy['order']!='ASC' && $orderBy['order']!='DESC')
            $orderBy['order'] = 'ASC';
        $column = $orderBy['orderBy'];
        $order = $orderBy['order'];
        
        
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT id, title, icon, prefix, suffix, status
                FROM `$table`
                ORDER BY $column $order
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
            return self::update($args['id'],$args['name'],$args['icon'],$args['prefix'],$args['suffix'],$args['categories']);
        if($action=='add')
            return self::create($args['name'],$args['icon'],$args['prefix'],$args['suffix']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $title, $icon, $prefix, $suffix, $categories)
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
        
        // Update categories
        $limit = 20;
        $offset = 0;
        $order = array('orderBy' => 'name', 'order' => 'ASC');
        $categoriesData = Category::getList($limit, $offset, $order);
        foreach($categories as $key => $category) // Update formating
        {
            unset($categories[$key]);
            $categories[$category] = '1';
        }
        foreach($categoriesData as $i) // Add categories not checked
        {
            if(!isset($categories[$i['keyword']]))
                $categories[$i['keyword']] = '0';
        }
        
        $table = $tables['categories_x_searchengines'];
        if(!self::getCategoriesFor($id))
        {
            // Create SQL arguments
            $columns = ''; $values = '';
            foreach($categories as $key => $value)
            {
                if(strlen($columns)==0)
                {
                    $columns .= "`$key`";
                    $values .= "$value";
                }
                else
                {
                    $columns .= ", `$key`";
                    $values .= ", $value";
                }
            }
            
            // Create categories
            $sql = "INSERT INTO `$table`
                    (`id`, `search_engine_id`, $columns) 
                    values (NULL, ?, $values)";
            $req = $bdd->prepare($sql);
            $req->execute(array($id));
            $req->closeCursor();
        }
        else
        {
            // Create SQL arguments
            $setup = '';
            foreach($categories as $key => $value)
            {
                if(strlen($setup)==0)
                    $setup .= "`$key` = $value";
                else
                    $setup .= ", `$key` = $value";
            }
            
            // Update categories
            $sql = "UPDATE `$table`
                    SET $setup
                    WHERE `search_engine_id` = ?";
            $req = $bdd->prepare($sql);
            $req->execute(array($id));
            $req->closeCursor();
        }
        
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
    
    public static function getCategoriesFor($id)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['categories_x_searchengines'];
        $sql = "SELECT *
                FROM `$table`
                WHERE `search_engine_id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $data = $req->fetch();
        $req->closeCursor();
        
        return $data;
    }
}