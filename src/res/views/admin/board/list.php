<?php 
use Language\Lang;
use Admin\Board;
use Gui\Window;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_board');
$title = $title .' > '. Lang::getText('manage_board');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/board.css" />
        <link rel="stylesheet" href="res/css/pagination.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_board'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('manage_board'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            ?>
            <h1><?= Lang::getText('manage_board'); ?></h1>
            <?php
            if(isset($_GET['status']) || isset($_POST['status']))
            {
                $status;
                if(isset($_POST['status']))
                    $status = $_POST['status'];
                else
                    $status = unserialize(urldecode($_GET['status']));

                Board::printStatus($status);
            }
            ?>
            <ul class="toolbar">
                <li><a href="admin.php"><button><?= Lang::getText('back'); ?></button></a></li>
                <li><button class="flat" onclick="openWindow('#addAction')"><?= Lang::getText('add'); ?></button></li>
            </ul>
            <?php
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
            $orderStatus = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'status', 'order' => 'DESC');
            $orderType = array('p' => $currentPage, 'nb' => $limit,
                                 'orderBy' => 'type', 'order' => 'DESC');
            $order = array('orderBy' => 'keyword', 'order' => 'ASC');
            if(isset($_GET['orderBy']) && isset($_GET['order']))
            {
                if($_GET['orderBy'] == 'keyword')
                {
                    $order['orderBy'] = 'keyword';
                    if($_GET['order']=='ASC') {$orderKeyword['order']='DESC'; $order['order']='ASC';}
                    else                      {$orderKeyword['order']='ASC'; $order['order']='DESC';}
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
            $linkOrderKeyword = Board::arrayToArgs($orderKeyword);
            $linkOrderStatus = Board::arrayToArgs($orderStatus);
            $linkOrderType = Board::arrayToArgs($orderType);
            $board = Board::getList($limit, $offset, $order);
            
            if(sizeof($board) == 0)
            {
                Lang::setModule('administration');
                ?><p class="info inline"><?= Lang::getText('not_content_to_display'); ?></p><?php
                Lang::setModule('admin_board');
            }
            else
            {
                ?>
            <table class="decorated">
                <tr>
                    <th><a href="?<?= $linkOrderKeyword ?>"><?= Lang::getText('board'); ?></a></th>
                    <th><a href="?<?= $linkOrderType ?>"><?= Lang::getText('type'); ?></a></th>
                    <th><a href="?<?= $linkOrderStatus ?>"><?= Lang::getText('status'); ?></a></th>
                    <th><?= Lang::getText('actions'); ?></th>
                </tr>
                <?php
                foreach($board as $item)
                {
                    $status = Lang::getText('enabled');
                    $nextState = 'disable';
                    if($item['status'] == 'disabled')
                    {
                        $nextState = 'enable';
                        $status = Lang::getText('disabled');
                    }
                    Lang::setModule('board');
                    $name = Lang::getText($item['keyword']);
                    Lang::setModule('admin_board');
                    $type = Lang::getText($item['type']);
                    $isEnabled = '';
                    if($item['status']=='enabled')
                        $isEnabled = 'green';
                    ?>
                <tr>
                    <th class="data">
                        <img class="icon" src="res/img/board/<?= $item['icon'] ?>" />
                        <div class="text">
                            <h3><?= $item['keyword'] ?></h3>
                            <h4><?= $name ?></h4>
                            <p><?= $item['url'] ?></p>
                        </div>
                    </th>
                    <td><?= $type ?></td>
                    <td><p class="info <?= $isEnabled ?>"><?= $status ?></p></td>
                    <td class="actions">
                        <a href="<?= $item['url'] ?>" title="<?= Lang::getText('visit'); ?>"><button><img src="res/img/actions/go.png"></button></a>
                        <a href="admin-edit-board.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="admin-<?= $nextState ?>-board.php?id=<?= $item['id'] ?>" title="<?= ($nextState=='enable' ? Lang::getText('enable') : Lang::getText('disable')) ?>"><button><img src="res/img/actions/<?= $nextState ?>.png"></button></a>
                        <a href="admin-remove-board.php?id=<?= $item['id'] ?>" title="<?= Lang::getText('remove'); ?>" onclick="return confirm('<?= Lang::getText('are_you_sure') ?>')"><button><img src="res/img/actions/remove.png"></button></a>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            
            $total = Board::getSize();
            $countActions = ceil($total / $limit);
            $currentPage = 1;
            if(isset($_GET['p']))
                $currentPage = $_GET['p'];
            $args = $order;
            $args['nb'] = $limit;
            $pagination = new Pagination($currentPage, $countActions, $args);
            $pagination->toHtml();
            ?>
		</div>
        <?php ob_start(); ?>
        <form method="post" action="admin-add-board.php">
            <table>
                <tr>
                    <th><?= Lang::getText('keyword'); ?></th>
                    <td colspan="2"><input type="text" name="keyword" value="keyword" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('url'); ?></th>
                    <td colspan="2"><input type="text" name="url" value="page.php" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('icon'); ?></th>
                    <td>res/img/board/</td>
                    <td><input type="text" name="icon" value="icon.png" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('type'); ?></th>
                    <td colspan="2">
                        <select name="type">
                            <option value="default" ><?= Lang::getText('default'); ?></option>
                            <option value="admin" ><?= Lang::getText('admin'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td colspan="2"><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('add'), 'addAction', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>