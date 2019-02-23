<?php

// src/res/core/Admin/Category.php

namespace Admin;
use Language\Lang;

class Category extends Administration
{
    private static $NAME = 'name';
    private static $KEYWORD = 'keyword';
    private static $STATUS = 'status';
    
    public static function find($id)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['categories'];
        $sql = "SELECT id, keyword, status
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
        $orderName = false;
        switch($orderBy['orderBy'])
        {
            case self::$KEYWORD:
            case self::$STATUS:
                break;
                
            case self::$NAME:
            default:
                $orderBy['orderBy'] = self::$KEYWORD;
                $orderName = true;
                break;
        }
        if($orderBy['order']!='ASC' && $orderBy['order']!='DESC')
            $orderBy['order'] = 'ASC';
        $column = $orderBy['orderBy'];
        $order = $orderBy['order'];
        
        
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['categories'];
        $sql = "SELECT id, keyword, status
                FROM `$table`
                ORDER BY $column $order
                LIMIT $limit
                OFFSET $offset";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        Lang::setModule('categories');
        $list = array();
        while($data = $req->fetch())
        {
            $data['name'] = Lang::getText($data['keyword']);
            $list[] = $data;
        }
        $req->closeCursor();
        
        if($orderName) 
        {
            if($orderBy['order']=='ASC') array_multisort(array_column($list, 'name'), SORT_ASC, $list);
            else                         array_multisort(array_column($list, 'name'), SORT_DESC, $list);
        }
        
        return $list;
    }
    
    public static function getSize()
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['categories'];
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
            return self::update($args['id'],$args['keyword'],$args['searchEngines']);
        if($action=='add')
            return self::create($args['keyword']);
        if($action=='remove')
            return self::remove($args['id']);
        if($action=='enable' || $action=='disable')
            return self::toggleStatus($args['id']);
    }
    
    public static function update($id, $keyword, $searchEngines)
    {
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['categories'];
        $sql = "UPDATE `$table`
                SET `keyword` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $id));
        $req->closeCursor();
		
		// TODO: Update rename column from cat x engines
		// TODO: Update create() to add column into catXengines
		// TODO: Update remove() to remove column into catXengines
		
		$table = $tables['categories_x_searchengines'];
		
		// Reset column
        $sql = "UPDATE `$table`
                SET `$keyword` = 0
                WHERE 1";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword, $id));
        $req->closeCursor();
		
		// Update search engine categories
		foreach($searchEngines as $se)
		{
			$id = substr($se, 2);
			if(!self::hasSearchEngine($id)) {
				// Insert search engine if isnt available
				$sql = "INSERT INTO `$table`
						(`id`, `search_engine_id`)
						VALUES (NULL, ?)";
				$req = $bdd->prepare($sql);
				$req->execute(array($id));
				$req->closeCursor();
			}
			// Check category for this search engine
			$sql = "UPDATE `$table`
					SET `$keyword` = 1
					WHERE `search_engine_id` = ?";
			$req = $bdd->prepare($sql);
			$req->execute(array($id));
			$req->closeCursor();
		}
        
        Lang::setModule('admin_categories');
        $status = array('success' => Lang::getText('category_updated_successfully', 
                                                  array('keyword' => $keyword)));
        return $status;
    }
    
    public static function create($keyword)
    {
        // Login to database
        require('res/php/db.php');

        // Insert data
        $table = $tables['categories'];
        $sql = "INSERT INTO `$table`
                (`id`, `keyword`, `status`)
                VALUES (NULL, ?, 'disabled')";
        $req = $bdd->prepare($sql);
        $req->execute(array($keyword));
        $req->closeCursor();
        
        Lang::setModule('admin_categories');
        $status = array('success' => Lang::getText('category_added_successfully'));
        return $status;
    }
    
    public static function remove($id)
    {
        // Login to database
        require('res/php/db.php');

        // Remove row
        $table = $tables['categories'];
        $sql = "DELETE FROM `$table`
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        $req->closeCursor();
        
        Lang::setModule('admin_categories');
        $status = array('success' => Lang::getText('category_removed_successfully'));
        return $status;
    }
    
    public static function toggleStatus($id)
    {
        // Get current status
        $item = self::find($id);
        $nextState = 'disabled';
        if($item['status'] == 'disabled')
            $nextState = 'enabled';
        
        // Login to database
        require('res/php/db.php');

        // Update status
        $table = $tables['categories'];
        $sql = "UPDATE `$table`
                SET `status` = ?
                WHERE `id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($nextState, $id));
        $req->closeCursor();
        
        Lang::setModule('admin_categories');
        $status = array('success' => Lang::getText('category_new_state_successfully', 
                                                  array('keyword' => $item['keyword'],
                                                        'new_status' => strtolower(Lang::getText($nextState)))));
        return $status;
    }
    
    public static function getSearchEnginesForCategory($keyword)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $table = $tables['search_engines'];
        $sql = "SELECT id, title, icon
                FROM `$table`
                ORDER BY `title` ASC";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        $list = array();
        while($data = $req->fetch())
        {
            $data['checked'] = false;
            $list[] = $data;
        }
        $req->closeCursor();
        
        // Get categories value for each search engines
        $table = $tables['categories_x_searchengines'];
        $sql = "SELECT search_engine_id
                FROM `$table`
                WHERE `$keyword` = 1";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        while($data = $req->fetch())
        {
            foreach($list as $key => $se)
            {
                if($se['id'] == $data['search_engine_id'])
                    $list[$key]['checked'] = true;
            }
        }
        $req->closeCursor();
        
        return $list;
    }
    
    private static function hasSearchEngine($id)
	{
        // Login to database
        require('res/php/db.php');
		
		// Run SQL
		$table = $tables['categories_x_searchengines'];
        $sql = "SELECT COUNT(*)
                FROM `$table`
                WHERE `search_engine_id` = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($id));
        
        // Fetching data
        $data = $req->fetch();
        $req->closeCursor();
		if($data['0']==0)
			return false;
		return true;
	}
    
}