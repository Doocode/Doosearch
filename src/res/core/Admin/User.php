<?php

// src/res/core/Admin/User.php

namespace Admin;
use Language\Lang;
use Account\Account;

class User extends Administration
{
    private static $PSEUDO = 'pseudo';
    private static $TYPE = 'type';
    private static $STATUS = 'status';
    
    public static function find($id)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['users'];
        $sql = "SELECT id, pseudo, email, type, status
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
            case self::$STATUS:
            case self::$TYPE:
                break;
            default:
                $orderBy['order'] = self::$PSEUDO;
                break;
        }
        if($orderBy['order']!='ASC' && $orderBy['order']!='DESC')
            $orderBy['order'] = 'ASC';
        $column = $orderBy['orderBy'];
        $order = $orderBy['order'];
        
        
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['users'];
        $sql = "SELECT id, pseudo, email, type, status
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
        $table = $tables['users'];
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
            return self::update($args['id'],$args['pseudo'],$args['email'],$args['password'],$args['type']);
        if($action=='add')
            return self::create($args['pseudo'],$args['email'],$args['type'],$args['password']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $pseudo, $email, $password, $type)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['users'];
        $sql = "UPDATE `$table`
                SET `pseudo` = ?, `email` = ?, `type` = ?, `password` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($pseudo, $email, $type, Account::hashPassword($password), $id));
        $req->closeCursor();
        
        Lang::setModule('admin_users');
        $status = array('success' => Lang::getText('user_updated_successfully', 
                                                  array('pseudo' => $pseudo)));
        return $status;
    }
    
    public static function create($pseudo, $email, $type, $password)
    {
       /* // Login to database
        require('res/php/db.php');

        // Insert data
        $table = $tables['users'];
        $sql = "INSERT INTO `$table`
                (`id`, `pseudo`, `email`, `password`, `type`, `status`)
                VALUES (NULL, ?, ?, ?, ?, 'disabled')";
        $req = $bdd->prepare($sql);
        $req->execute(array($pseudo, $email, $type, $password));
        $req->closeCursor();*/
        Account::register($email, $pseudo, $password, $password, false);
        // TODO: Update account type
        
        Lang::setModule('admin_users');
        $status = array('success' => Lang::getText('user_added_successfully'));
        return $status;
    }
    
    public static function remove($id)
    {
        // Login to database
        require('res/php/db.php');

        // Remove row
        $table = $tables['users'];
        $sql = "DELETE FROM `$table`
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $req->closeCursor();
        
        Lang::setModule('admin_users');
        $status = array('success' => Lang::getText('user_removed_successfully'));
        return $status;
    }
    
    public static function toggleStatus($id)
    {
        // Get current status
        $user = self::find($id);
        $nextState = 'disabled';
        if($user['status'] == 'disabled')
            $nextState = 'enabled';
        
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['users'];
        $sql = "UPDATE `$table`
                SET `status` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($nextState, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_users');
        $status = array('success' => Lang::getText('user_new_state_successfully', 
                                                  array('pseudo' => $user['pseudo'],
                                                        'new_status' => strtolower(Lang::getText($nextState)))));
        return $status;
    }
}