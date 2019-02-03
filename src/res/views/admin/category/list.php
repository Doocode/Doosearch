<?php 
use Language\Lang;
use Admin\Category;
use Gui\Window;
use Gui\PagePath;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_categories');
$title = $title .' > '. Lang::getText('manage_categories');
PagePath::addItem(Lang::getText('manage_categories'), 'admin-list-category.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/categories.css" />
        <link rel="stylesheet" href="res/css/pagination.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_categories'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('manage_categories'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('manage_categories'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_categories'); ?>
                
                <ul class="toolbar">
                    <li><button onclick="openWindow('#addCategory')"><?= Lang::getText('add'); ?></button></li>
                    <li><a href="admin-list-category.php"><button class="flat"><?= Lang::getText('refresh'); ?></button></a></li>
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

                Category::printStatus($status);
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
            $orderName = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'name', 'order' => 'DESC');
            $orderKeyword = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'keyword', 'order' => 'DESC');
            $orderStatus = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'status', 'order' => 'DESC');
            $order = array('orderBy' => 'name', 'order' => 'ASC');
            if(isset($_GET['orderBy']) && isset($_GET['order']))
            {
                if($_GET['orderBy'] == 'name')
                {
                    $order['orderBy'] = 'name';
                    if($_GET['order']=='ASC') {$orderName['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderName['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'keyword')
                {
                    $order['orderBy'] = 'keyword';
                    if($_GET['order']=='ASC') {$orderKeyword['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderKeyword['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'status')
                {
                    $order['orderBy'] = 'status';
                    if($_GET['order']=='ASC') {$orderStatus['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderStatus['order']='ASC'; $order['order']='DESC';}
                }
            }
            $linkOrderName = Category::arrayToArgs($orderName);
            $linkOrderKeyword = Category::arrayToArgs($orderKeyword);
            $linkOrderStatus = Category::arrayToArgs($orderStatus);
            $categories = Category::getList($limit, $offset, $order);
            
            if(sizeof($categories) == 0)
            {
                Lang::setModule('administration');
                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                Lang::setModule('admin_categories');
            }
            else
            {
                Lang::setModule('admin_categories');
                ?>
            <table class="decorated">
                <tr>
                    <th><a href="?<?= $linkOrderName ?>"><?= Lang::getText('categories'); ?></a></th>
                    <th><a href="?<?= $linkOrderKeyword ?>"><?= Lang::getText('keyword'); ?></a></th>
                    <th><a href="?<?= $linkOrderStatus ?>"><?= Lang::getText('status'); ?></a></th>
                    <th><?= Lang::getText('actions'); ?></th>
                </tr>
                <?php
                foreach($categories as $item)
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
                        <div class="text">
                            <h3><?= $item['name'] ?></h3>
                            <!--p>COUNT ITEMS : 0 items</p-->
                        </div>
                    </th>
                    <td><?= $item['keyword'] ?></td>
                    <td><p class="info <?= $isEnabled ?>"><?= $status ?></p></td>
                    <td class="actions">
                        <a href="admin-edit-category.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="admin-<?= $nextState ?>-category.php?id=<?= $item['id'] ?>" title="<?= ($nextState=='enable' ? Lang::getText('enable') : Lang::getText('disable')) ?>"><button><img src="res/img/actions/<?= $nextState ?>.png"></button></a>
                        <a href="admin-remove-category.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('remove'); ?>" onclick="return confirm('<?= Lang::getText('are_you_sure') ?>')"><button><img src="res/img/actions/remove.png"></button></a>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            
            $total = Category::getSize();
            $countCategories = ceil($total / $limit);
            $currentPage = 1;
            if(isset($_GET['p']))
                $currentPage = $_GET['p'];
            $args = $order;
            $args['nb'] = $limit;
            $pagination = new Pagination($currentPage, $countCategories, $args);
            $pagination->toHtml();
            ?>
		</div>
        <?php ob_start(); ?>
        <form method="post" action="admin-add-category.php">
            <table>
                <tr>
                    <th><?= Lang::getText('keyword'); ?></th>
                    <td><input type="text" name="keyword" value="keyword" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('add'), 'addCategory', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>