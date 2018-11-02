<?php 
use Language\Lang;
use Admin\SearchEngine;
use Gui\Window;

Lang::setSection('administration');
$title = $_APP['app_name'] .' > '. Lang::getKey('administration');
Lang::setSection('admin_search_engines');
$title = $title .' > '. Lang::getKey('manage_search_engines');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/search-engines.css" />
        <title><?= $title ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('admin_search_engines'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getKey('manage_search_engines'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            ?>
            <h1><?= Lang::getKey('manage_search_engines'); ?></h1>
            <?php
            if(isset($_POST['status']))
            {
                $status = $_POST['status'];
                $bgColor = '';
                $msg = '';
                if(isset($status['success']))
                {
                    $bgColor = 'green';
                    $msg = $status['success'];
                }
                else if(isset($status['error']))
                {
                    $bgColor = 'red';
                    $msg = $status['error'];
                }
                else if(isset($status['warning']))
                {
                    $bgColor = 'orange';
                    $msg = $status['warning'];
                }
                ?><p class="info inline <?= $bgColor ?>"><?= $msg ?></p><?php
            }
            ?>
            <ul class="toolbar">
                <li><a href="admin.php"><button><?= Lang::getKey('back'); ?></button></a></li>
                <li><button class="flat" onclick="openWindow('#addEngine')"><?= Lang::getKey('add'); ?></button></li>
            </ul>
            <?php
            $searchEngines = SearchEngine::getList();
            if(sizeof($searchEngines) == 0)
            {
                Lang::setSection('administration');
                ?><p class="info inline"><?= Lang::getKey('not_content_to_display'); ?></p><?php
                Lang::setSection('admin_search_engines');
            }
            else
            {
                ?>
            <table class="decorated">
                <tr>
                    <th><?= Lang::getKey('search_engines'); ?></th>
                    <th><?= Lang::getKey('status'); ?></th>
                    <th><?= Lang::getKey('actions'); ?></th>
                </tr>
                <?php
                foreach($searchEngines as $item)
                {
                    $status = Lang::getKey('enabled');
                    ?>
                <tr>
                    <th class="data">
                        <img class="icon" src="res/img/motors/<?= $item['icon'] ?>" />
                        <div class="text">
                            <h3><?= $item['title'] ?></h3>
                            <p><?= $item['prefix'] .'<strong>'. Lang::getKey('query') .'</strong>'. $item['suffix']?></p>
                        </div>
                    </th>
                    <td><?= $status ?></td>
                    <td class="actions">
                        <!--a href="admin-edit-search-engine.php?id=<?= $item['id'] ?>" title="<?= Lang::getKey('edit'); ?>"><button><img src="res/img/actions/manage.png"></button></a>
                        <a href="#"><button><img src="res/img/actions/disable.png"></button></a>
                        <a href="admin-remove-search-engine.php?id=<?= $item['id'] ?>" title="<?= Lang::getKey('remove'); ?>" onclick="if(confirm('Sure ?'))"><button><img src="res/img/actions/remove.png"></button></a-->
                    </td>
                </tr>
                    <?php
                }
                ?>
            </table>
                <?php
            }
            ?>
		</div>
        <?php ob_start(); ?>
        <form method="post" action="admin-add-search-engine.php">
            <table>
                <tr>
                    <th><?= Lang::getKey('name'); ?></th>
                    <td><input type="text" name="name" value="<?= Lang::getKey('name'); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('icon'); ?></th>
                    <td><input type="text" name="icon" value="<?= Lang::getKey('icon'); ?>.png" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('prefix'); ?></th>
                    <td><input type="text" name="prefix" value="http://domain.com/search/" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('suffix'); ?></th>
                    <td><input type="text" name="suffix" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getKey('submit'); ?>"/></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getKey('add'), 'addEngine', ob_get_clean());
        $loginEditor->toHtml();
        ?>
    </body>
</html>