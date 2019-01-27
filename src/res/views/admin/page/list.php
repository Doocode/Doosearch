<?php 
use Language\Lang;
use Admin\Page;
use Gui\Window;
use Gui\PagePath;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_pages');
$title = $title .' > '. Lang::getText('manage_pages');
PagePath::addItem(Lang::getText('manage_pages'), 'admin-list-page.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/pages.css" />
        <link rel="stylesheet" href="res/css/pagination.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_pages'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('manage_pages'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('manage_pages'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_pages'); ?>
                
                <ul class="toolbar">
                    <li><button onclick="openWindow('#addPage')"><?= Lang::getText('add'); ?></button></li>
                    <li><a href="admin-list-page.php"><button class="flat"><?= Lang::getText('refresh'); ?></button></a></li>
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

                Page::printStatus($status);
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
            $orderKeyword = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'keyword', 'order' => 'DESC');
            $orderPriority = array('p' => $currentPage, 'nb' => $limit,
                                   'orderBy' => 'priority', 'order' => 'DESC');
            $orderStatus = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'status', 'order' => 'DESC');
            $order = array('orderBy' => 'keyword', 'order' => 'ASC');
            if(isset($_GET['orderBy']) && isset($_GET['order']))
            {
                if($_GET['orderBy'] == 'keyword')
                {
                    $order['orderBy'] = 'keyword';
                    if($_GET['order']=='ASC') {$orderKeyword['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderKeyword['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'priority')
                {
                    $order['orderBy'] = 'priority';
                    if($_GET['order']=='ASC') {$orderPriority['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderPriority['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'status')
                {
                    $order['orderBy'] = 'status';
                    if($_GET['order']=='ASC') {$orderStatus['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderStatus['order']='ASC'; $order['order']='DESC';}
                }
            }
            $linkOrderKeyword = Page::arrayToArgs($orderKeyword);
            $linkOrderPriority = Page::arrayToArgs($orderPriority);
            $linkOrderStatus = Page::arrayToArgs($orderStatus);
            $pages = Page::getList($limit, $offset, $order);
            
            if(sizeof($pages) == 0)
            {
                Lang::setModule('administration');
                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                Lang::setModule('admin_pages');
            }
            else
            {
                ?>
            <table class="decorated">
                <tr>
                    <th><a href="?<?= $linkOrderKeyword ?>"><?= Lang::getText('pages'); ?></a></th>
                    <th><a href="?<?= $linkOrderPriority ?>"><?= Lang::getText('priority'); ?></a></th>
                    <th><a href="?<?= $linkOrderStatus ?>"><?= Lang::getText('status'); ?></a></th>
                    <th><?= Lang::getText('actions'); ?></th>
                </tr>
                <?php
                foreach($pages as $item)
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
                    Lang::setModule('header');
                    $name = Lang::getText($item['keyword']);
                    Lang::setModule('admin_pages');
                    ?>
                <tr>
                    <th class="data">
                        <img class="icon" src="res/img/page.png" />
                        <div class="text">
                            <h3><?= $item['keyword'] . ' ('.$name.')' ?></h3>
                            <p><?= $item['url'] ?></p>
                        </div>
                    </th>
                    <td><?= $item['priority'] ?></td>
                    <td><p class="info <?= $isEnabled ?>"><?= $status ?></p></td>
                    <td class="actions">
                        <a href="<?= $item['url'] ?>" title="<?= Lang::getText('visit'); ?>"><button><img src="res/img/actions/go.png"></button></a>
                        <a href="admin-edit-page.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="admin-<?= $nextState ?>-page.php?id=<?= $item['id'] ?>" title="<?= ($nextState=='enable' ? Lang::getText('enable') : Lang::getText('disable')) ?>"><button><img src="res/img/actions/<?= $nextState ?>.png"></button></a>
                        <a href="admin-remove-page.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('remove'); ?>" onclick="return confirm('<?= Lang::getText('are_you_sure') ?>')"><button><img src="res/img/actions/remove.png"></button></a>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            
            $total = Page::getSize();
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
        <form method="post" action="admin-add-page.php">
            <table>
                <tr>
                    <th><?= Lang::getText('keyword'); ?></th>
                    <td><input type="text" name="keyword" value="keyword" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('url'); ?></th>
                    <td><input type="text" name="url" value="page.php" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('priority'); ?></th>
                    <td><input type="number" name="priority" value="1000" min="0" max="1000" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('add'), 'addPage', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>