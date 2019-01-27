<?php 
use Language\Lang;
use Admin\SearchEngine;
use Gui\PagePath;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_search_engines');
$title = $title .' > '. Lang::getText('edit_search_engine');
PagePath::addItem(Lang::getText('manage_search_engines'), 'admin-list-search-engine.php');
PagePath::addItem(Lang::getText('edit_search_engine'), '#');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/search-engines.css" />
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_search_engines'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('edit_search_engine'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin-list-search-engine.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('edit_search_engine'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_search_engines'); ?>
                
                <ul class="toolbar">
                    <li><a href="admin-list-search-engine.php"><button class="flat"><?= Lang::getText('back'); ?></button></a></li>
                </ul>
            </div>
            
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
                ?><p class="info <?= $bgColor ?>"><?= $msg ?></p><?php
            }
            
            $engine = SearchEngine::find($_GET['id']); 
            ?>
            <form method="post" action="admin-update-search-engine.php">
                <input type="hidden" name="id" value="<?= $engine['id'] ?>" />
                <table class="decorated" id="editForm">
                    <tr></tr>
                    <tr>
                        <th><?= Lang::getText('name'); ?></th>
                        <td colspan="2"><input type="text" name="name" value="<?= $engine['title'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('icon'); ?></th>
                        <td>res/img/</td>
                        <td><input type="text" name="icon" value="<?= $engine['icon'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('prefix'); ?></th>
                        <td colspan="2"><input type="text" name="prefix" value="<?= $engine['prefix'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('suffix'); ?></th>
                        <td colspan="2"><input type="text" name="suffix" value="<?= $engine['suffix'] ?>" /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td colspan="2"><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                    </tr>
                </table>
            </form>
		</div>
    </body>
</html>