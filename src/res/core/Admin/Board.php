<?php

// src/res/core/Admin/Board.php

namespace Admin;
use Language\Lang;

class Board extends Administration
{
    private static $KEYWORD = 'keyword';
    private static $STATUS = 'status';
    private static $TYPE = 'type';
    
    public static function find($id)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['board'];
        $sql = "SELECT id, keyword, url, status, icon, type
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
            case self::$TYPE:
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
        $table = $tables['board'];
        $sql = "SELECT id, keyword, icon, url, status, type
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
        $table = $tables['board'];
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
            return self::update($args['id'],$args['keyword'],$args['icon'],$args['url'],$args['type']);
        if($action=='add')
            return self::create($args['keyword'],$args['url'],$args['icon'],$args['type']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $keyword, $icon, $url, $type)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['board'];
        $sql = "UPDATE `$table`
                SET `keyword` = ?, `url` = ?, `icon` = ?, `type` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $url, $icon, $type, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_board');
        $status = array('success' => Lang::getText('action_updated_successfully', 
                                                  array('keyword' => $keyword)));
        return $status;
    }
    
    public static function create($keyword, $url, $icon, $type)
    {
        // Login to database
        require('res/php/db.php');

        // Insert data
        $table = $tables['board'];
        $sql = "INSERT INTO `$table`
                (`id`, `keyword`, `url`, `icon`, `type`, `status`)
                VALUES (NULL, ?, ?, ?, ?, 'disabled')";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $url, $icon, $type));
        $req->closeCursor();
        
        Lang::setModule('admin_board');
        $status = array('success' => Lang::getText('action_added_successfully'));
        return $status;
    }
    
    public static function remove($id)
    {
        // Login to database
        require('res/php/db.php');

        // Remove row
        $table = $tables['board'];
        $sql = "DELETE FROM `$table`
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $req->closeCursor();
        
        Lang::setModule('admin_board');
        $status = array('success' => Lang::getText('action_removed_successfully'));
        return $status;
    }
    
    public static function toggleStatus($id)
    {
        // Get current status
        $action = self::find($id);
        $nextState = 'disabled';
        if($action['status'] == 'disabled')
            $nextState = 'enabled';
        
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['board'];
        $sql = "UPDATE `$table`
                SET `status` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($nextState, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_board');
        $status = array('success' => Lang::getText('action_new_state_successfully', 
                                                  array('keyword' => $action['keyword'],
                                                        'new_status' => strtolower(Lang::getText($nextState)))));
        return $status;
    }
}