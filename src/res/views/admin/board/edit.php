<?php 
use Language\Lang;
use Admin\Board;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_board');
$title = $title .' > '. Lang::getText('edit_action');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/board.css" />
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_board'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('edit_action'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            ?>
            <h1><?= Lang::getText('edit_action'); ?></h1>
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
            ?>
            <ul class="toolbar">
                <li><a href="admin-list-board.php"><button class="flat"><?= Lang::getText('back'); ?></button></a></li>
            </ul>
            <?php
            $board_action = Board::find($_GET['id']);
            $selectAdmin = ''; $selectDefault = '';
            if($board_action['type'] == 'admin')
                $selectAdmin = 'selected';
            else
                $selectDefault = 'selected';
            ?>
            <form method="post" action="admin-update-board.php">
                <input type="hidden" name="id" value="<?= $board_action['id'] ?>" />
                <table class="decorated" id="editForm">
                    <tr></tr>
                    <tr>
                        <th><?= Lang::getText('keyword'); ?></th>
                        <td colspan="2"><input type="text" name="keyword" value="<?= $board_action['keyword'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('icon'); ?></th>
                        <td>res/img/board/</td>
                        <td><input type="text" name="icon" value="<?= $board_action['icon'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('url'); ?></th>
                        <td colspan="2"><input type="text" name="url" value="<?= $board_action['url'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('type'); ?></th>
                        <td colspan="2">
                            <select name="type">
                                <option value="default" <?= $selectDefault ?> ><?= Lang::getText('default') ?></option>
                                <option value="admin" <?= $selectAdmin ?> ><?= Lang::getText('admin') ?></option>
                            </select>
                        </td>
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