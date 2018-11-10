<?php

// src/res/core/Admin/Page.php

namespace Admin;
use Language\Lang;

class Page extends Administration
{
    private static $KEYWORD = 'keyword';
    private static $PRIORITY = 'priority';
    private static $STATUS = 'status';
    
    public static function find($id)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['pages'];
        $sql = "SELECT id, keyword, url, priority, status
                FROM `$table`
                WHERE id = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        
        // Fetching data
        $data = $req->fetch();
        $req->closeCursor();
        
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
            case self::$KEYWORD:
            case self::$STATUS:
            case self::$PRIORITY:
                break;
            default:
                $orderBy = self::$NAME;
                break;
        }
        if($orderBy['order']!='ASC' && $orderBy['order']!='DESC')
            $orderBy['order'] = 'ASC';
        $column = $orderBy['orderBy'];
        $order = $orderBy['order'];
        
        
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['pages'];
        $sql = "SELECT id, keyword, url, priority, status
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
        $table = $tables['pages'];
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
            return self::update($args['id'],$args['keyword'],$args['url'],$args['priority']);
        if($action=='add')
            return self::create($args['keyword'],$args['url'],$args['priority']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $keyword, $url, $priority)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['pages'];
        $sql = "UPDATE `$table`
                SET `keyword` = ?, `url` = ?, `priority` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $url, $priority, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_pages');
        $status = array('success' => Lang::getText('page_updated_successfully', 
                                                  array('keyword' => $keyword)));
        return $status;
    }
    
    public static function create($keyword, $url, $priority)
    {
        // Login to database
        require('res/php/db.php');

        // Insert data
        $table = $tables['pages'];
        $sql = "INSERT INTO `$table`
                (`id`, `keyword`, `url`, `priority`, `status`)
                VALUES (NULL, ?, ?, ?, 'disabled')";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $url, $priority));
        $req->closeCursor();
        
        Lang::setModule('admin_pages');
        $status = array('success' => Lang::getText('page_added_successfully'));
        return $status;
    }
    
    public static function remove($id)
    {
        // Login to database
        require('res/php/db.php');

        // Remove row
        $table = $tables['pages'];
        $sql = "DELETE FROM `$table`
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $req->closeCursor();
        
        Lang::setModule('admin_pages');
        $status = array('success' => Lang::getText('page_removed_successfully'));
        return $status;
    }
    
    public static function toggleStatus($id)
    {
        // Get current status
        $page = self::find($id);
        $nextState = 'disabled';
        if($page['status'] == 'disabled')
            $nextState = 'enabled';
        
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['pages'];
        $sql = "UPDATE `$table`
                SET `status` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($nextState, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_pages');
        $status = array('success' => Lang::getText('page_new_state_successfully', 
                                                  array('keyword' => $page['keyword'],
                                                        'new_status' => strtolower(Lang::getText($nextState)))));
        return $status;
    }
}