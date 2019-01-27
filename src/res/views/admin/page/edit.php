<?php 
use Language\Lang;
use Admin\Page;
use Gui\PagePath;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_pages');
$title = $title .' > '. Lang::getText('edit_page');
PagePath::addItem(Lang::getText('manage_pages'), 'admin-list-page.php');
PagePath::addItem(Lang::getText('edit_page'), '#');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/page.css" />
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_pages'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('edit_page'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            ?>
            <h1><?= Lang::getText('edit_page'); ?></h1>
            <?php PagePath::toHtml();
            Lang::setModule('admin_pages');
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
            ?>
            <ul class="toolbar">
                <li><a href="admin-list-page.php"><button class="flat"><?= Lang::getText('back'); ?></button></a></li>
            </ul>
            <?php $page = Page::find($_GET['id']); ?>
            <form method="post" action="admin-update-page.php">
                <input type="hidden" name="id" value="<?= $page['id'] ?>" />
                <table class="decorated" id="editForm">
                    <tr></tr>
                    <tr>
                        <th><?= Lang::getText('keyword'); ?></th>
                        <td><input type="text" name="keyword" value="<?= $page['keyword'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('url'); ?></th>
                        <td><input type="text" name="url" value="<?= $page['url'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('priority'); ?></th>
                        <td><input type="number" name="priority" value="<?= $page['priority'] ?>" min="0" max="1000" /></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                    </tr>
                </table>
            </form>
		</div>
    </body>
</html>