<?php 
use Language\Lang;
use Admin\SearchEngine;
use Admin\Category;
use Gui\Window;
use Gui\PagePath;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_search_engines');
$title = $title .' > '. Lang::getText('manage_search_engines');
PagePath::addItem(Lang::getText('manage_search_engines'), 'admin-list-search-engine.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/search-engines.css" />
        <link rel="stylesheet" href="res/css/pagination.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_search_engines'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('manage_search_engines'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('manage_search_engines'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_search_engines'); ?>
                
                <ul class="toolbar">
                    <li><button onclick="openWindow('#addEngine')"><?= Lang::getText('add'); ?></button></li>
                    <li><a href="admin-list-search-engine.php"><button class="flat"><?= Lang::getText('refresh'); ?></button></a></li>
                </ul>
            </div>
            
            <?php
            if(isset($_GET['status']) || isset($_POST['status']))
            {
                $status;
                if(isset($_POST['status']))
                    $status = $_POST['status'];
                else
                    $status = unserialize(urldecode($_GET['status']));

                SearchEngine::printStatus($status);
            }
            
            $limit = 20;
            $offset = 0;
            $currentPage = 1;
            if(isset($_GET['nb']) && is_numeric($_GET['nb']))
                $limit = $_GET['nb'];
            if(isset($_GET['p']) && is_numeric($_GET['p']))
            {
                $offset = ($_GET['p'] - 1) * $limit;
                $currentPage = $_GET['p'];
            }
            
            // Order elements
            $orderTitle = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'title', 'order' => 'DESC');
            $orderStatus = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'status', 'order' => 'DESC');
            $order = array('orderBy' => 'title', 'order' => 'ASC');
            if(isset($_GET['orderBy']) && isset($_GET['order']))
            {
                if($_GET['orderBy'] == 'title')
                {
                    $order['orderBy'] = 'title';
                    if($_GET['order']=='ASC') {$orderTitle['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderTitle['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'status')
                {
                    $order['orderBy'] = 'status';
                    if($_GET['order']=='ASC') {$orderStatus['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderStatus['order']='ASC'; $order['order']='DESC';}
                }
            }
            $linkOrderTitle = SearchEngine::arrayToArgs($orderTitle);
            $linkOrderStatus = SearchEngine::arrayToArgs($orderStatus);
            $searchEngines = SearchEngine::getList($limit, $offset, $order);
            
            if(sizeof($searchEngines) == 0)
            {
                Lang::setModule('administration');
                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                Lang::setModule('admin_search_engines');
            }
            else
            {
                ?>
            <table class="decorated">
                <tr>
                    <th><a href="?<?= $linkOrderTitle ?>"><?= Lang::getText('search_engines'); ?></a></th>
                    <th><a href="?<?= $linkOrderStatus ?>"><?= Lang::getText('status'); ?></a></th>
                    <th><?= Lang::getText('actions'); ?></th>
                </tr>
                <?php
                foreach($searchEngines as $item)
                {
                    $status = Lang::getText('enabled');
                    $nextState = 'disable';
                    if($item['status'] == 'disabled')
                    {
                        $nextState = 'enable';
                        $status = Lang::getText('disabled');
                    }
                    $isEnabled = '';
                    if($item['status']=='enabled')
                        $isEnabled = 'green';
                    ?>
                <tr>
                    <th class="data">
                        <img class="icon" src="res/img/motors/<?= $item['icon'] ?>" />
                        <div class="text">
                            <h3><?= $item['title'] ?></h3>
                            <p><?= $item['prefix'] .'<strong>'. Lang::getText('query') .'</strong>'. $item['suffix']?></p>
                        </div>
                    </th>
                    <td><p class="info <?= $isEnabled ?>"><?= $status ?></p></td>
                    <td class="actions">
                        <a href="admin-edit-search-engine.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="admin-<?= $nextState ?>-search-engine.php?id=<?= $item['id'] ?>" title="<?= ($nextState=='enable' ? Lang::getText('enable') : Lang::getText('disable')) ?>"><button><img src="res/img/actions/<?= $nextState ?>.png"></button></a>
                        <a href="admin-remove-search-engine.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('remove'); ?>" onclick="return confirm('<?= Lang::getText('are_you_sure') ?>')"><button><img src="res/img/actions/remove.png"></button></a>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            
            $total = SearchEngine::getSize();
            $countPages = ceil($total / $limit);
            $currentPage = 1;
            if(isset($_GET['p']))
                $currentPage = $_GET['p'];
            $args = $order;
            $args['nb'] = $limit;
            $pagination = new Pagination($currentPage, $countPages, $args);
            $pagination->toHtml();
            ?>
		</div>
        <?php ob_start(); ?>
        <form method="post" action="admin-add-search-engine.php">
            <table>
                <tr>
                    <th><?= Lang::getText('name'); ?></th>
                    <td><input type="text" name="name" value="<?= Lang::getText('name'); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('icon'); ?></th>
                    <td><input type="text" name="icon" value="<?= Lang::getText('icon'); ?>.png" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('prefix'); ?></th>
                    <td><input type="text" name="prefix" value="http://domain.com/search/" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('suffix'); ?></th>
                    <td><input type="text" name="suffix" /></td>
                </tr>
                <tr>
                    <th><?php Lang::setModule('admin_categories'); echo Lang::getText('categories'); ?></th>
                    <td>
                        <div id="categories">
                            <?php
            
                            $categories = Category::getList(20, 0, array('orderBy' => 'name', 'order' => 'ASC'));
                            Lang::setModule('admin_search_engines');
                            
                            if(sizeof($categories) == 0)
                            {
                                Lang::setModule('administration');
                                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                                Lang::setModule('admin_categories');
                            }
                            else
                            {
                                foreach($categories as $item)
                                {
                                    ?>
                                    <input type="checkbox" name="categories[]" id="<?= $item['keyword']; ?>" value="<?= $item['keyword']; ?>" />
                                    <label for="<?= $item['keyword']; ?>"><?= $item['name']; ?></label>
                                    <?php
                                }
                            }
                            Lang::setModule('admin_search_engines');
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('add'), 'addEngine', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>