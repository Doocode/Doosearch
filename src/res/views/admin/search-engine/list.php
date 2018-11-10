<?php 
use Language\Lang;
use Admin\SearchEngine;
use Gui\Window;
use Gui\Pagination;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_search_engines');
$title = $title .' > '. Lang::getText('manage_search_engines');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
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
            <?php
            ?>
            <h1><?= Lang::getText('manage_search_engines'); ?></h1>
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
            ?>
            <ul class="toolbar">
                <li><a href="admin.php"><button><?= Lang::getText('back'); ?></button></a></li>
                <li><button class="flat" onclick="openWindow('#addEngine')"><?= Lang::getText('add'); ?></button></li>
            </ul>
            <?php
            $limit = 20;
            $offset = 0;
            if(isset($_GET['nb']) && is_numeric($_GET['nb']))
                $limit = $_GET['nb'];
            if(isset($_GET['p']) && is_numeric($_GET['p']))
                $offset = ($_GET['p'] - 1) * $limit;
            $searchEngines = SearchEngine::getList($limit, $offset);
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
                    <th><?= Lang::getText('search_engines'); ?></th>
                    <th><?= Lang::getText('status'); ?></th>
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
                    ?>
                <tr>
                    <th class="data">
                        <img class="icon" src="res/img/motors/<?= $item['icon'] ?>" />
                        <div class="text">
                            <h3><?= $item['title'] ?></h3>
                            <p><?= $item['prefix'] .'<strong>'. Lang::getText('query') .'</strong>'. $item['suffix']?></p>
                        </div>
                    </th>
                    <td><?= $status ?></td>
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
            $pagination = new Pagination($currentPage, $countPages, array('nb'=>$limit));
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