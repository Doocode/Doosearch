<?php 
use Language\Lang;
use Admin\User;
use Gui\Window;
use Gui\PagePath;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_users');
$title = $title .' > '. Lang::getText('manage_users');
PagePath::addItem(Lang::getText('manage_users'), 'admin-list-user.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/users.css" />
        <link rel="stylesheet" href="res/css/pagination.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_users'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('manage_users'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('manage_users'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_users'); ?>
                
                <ul class="toolbar">
                    <li><button onclick="openWindow('#addUser')"><?= Lang::getText('add'); ?></button></li>
                    <li><a href="admin-list-user.php"><button class="flat"><?= Lang::getText('refresh'); ?></button></a></li>
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

                User::printStatus($status);
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
            $orderPseudo = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'pseudo', 'order' => 'DESC');
            $orderType = array('p' => $currentPage, 'nb' => $limit,
                                'orderBy' => 'type', 'order' => 'DESC');
            $orderStatus = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'status', 'order' => 'DESC');
            $order = array('orderBy' => 'pseudo', 'order' => 'ASC');
            if(isset($_GET['orderBy']) && isset($_GET['order']))
            {
                if($_GET['orderBy'] == 'pseudo')
                {
                    $order['orderBy'] = 'pseudo';
                    if($_GET['order']=='ASC') {$orderType['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderType['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'type')
                {
                    $order['orderBy'] = 'type';
                    if($_GET['order']=='ASC') {$orderType['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderType['order']='ASC'; $order['order']='DESC';}
                }
                else if($_GET['orderBy'] == 'status')
                {
                    $order['orderBy'] = 'status';
                    if($_GET['order']=='ASC') {$orderStatus['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderStatus['order']='ASC'; $order['order']='DESC';}
                }
            }
            $linkOrderPseudo = User::arrayToArgs($orderPseudo);
            $linkOrderType = User::arrayToArgs($orderType);
            $linkOrderStatus = User::arrayToArgs($orderStatus);
            $users = User::getList($limit, $offset, $order);
            
            if(sizeof($users) == 0)
            {
                Lang::setModule('administration');
                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                Lang::setModule('admin_users');
            }
            else
            {
                ?>
            <table class="decorated">
                <tr>
                    <th><a href="?<?= $linkOrderPseudo ?>"><?= Lang::getText('users'); ?></a></th>
                    <th><a href="?<?= $linkOrderType ?>"><?= Lang::getText('type'); ?></a></th>
                    <th><a href="?<?= $linkOrderStatus ?>"><?= Lang::getText('status'); ?></a></th>
                    <th><?= Lang::getText('actions'); ?></th>
                </tr>
                <?php
                foreach($users as $item)
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
                        <img class="icon" src="res/img/profile.png" />
                        <div class="text">
                            <h3><?= $item['pseudo'] ?></h3>
                            <p><?= $item['email'] ?></p>
                        </div>
                    </th>
                    <td><?= Lang::getText($item['type']) ?></td>
                    <td><p class="info <?= $isEnabled ?>"><?= $status ?></p></td>
                    <td class="actions">
                        <a href="admin-edit-user.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="admin-<?= $nextState ?>-user.php?id=<?= $item['id'] ?>" title="<?= ($nextState=='enable' ? Lang::getText('enable') : Lang::getText('disable')) ?>"><button><img src="res/img/actions/<?= $nextState ?>.png"></button></a>
                        <a href="admin-remove-user.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('remove'); ?>" onclick="return confirm('<?= Lang::getText('are_you_sure') ?>')"><button><img src="res/img/actions/remove.png"></button></a>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            
            $total = User::getSize();
            $countUsers = ceil($total / $limit);
            $currentPage = 1;
            if(isset($_GET['p']))
                $currentPage = $_GET['p'];
            $args = $order;
            $args['nb'] = $limit;
            $pagination = new Pagination($currentPage, $countUsers, $args);
            $pagination->toHtml();
            ?>
		</div>
        <?php ob_start(); ?>
        <form method="post" action="admin-add-user.php">
            <table>
                <tr>
                    <th><?= Lang::getText('pseudo'); ?></th>
                    <td><input type="text" name="pseudo" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('email'); ?></th>
                    <td><input type="mail" name="email" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('password'); ?></th>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('type'); ?></th>
                    <td>
                        <select name="type">
                            <option value="default"><?= Lang::getText('default') ?></option>
                            <option value="admin" ><?= Lang::getText('admin') ?></option>
                            <option value="demo" ><?= Lang::getText('demo') ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('add'), 'addUser', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>