<?php 
use Language\Lang;
use Admin\User;
use Gui\PagePath;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_users');
$title = $title .' > '. Lang::getText('edit_user');
PagePath::addItem(Lang::getText('manage_users'), 'admin-list-user.php');
PagePath::addItem(Lang::getText('edit_user'), '#');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/users.css" />
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_users'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('edit_user'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin-list-user.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('edit_user'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_users'); ?>
                
                <ul class="toolbar">
                    <li><a href="admin-list-user.php"><button class="flat"><?= Lang::getText('back'); ?></button></a></li>
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
            
            $user = User::find($_GET['id']);
            $selectAdmin = ''; $selectDefault = ''; $selectDemo = '';
            if($user['type'] == 'admin')
                $selectAdmin = 'selected';
            else if($user['type'] == 'demo')
                $selectDemo = 'selected';
            else
                $selectDefault = 'selected';
            ?>
            <form method="post" action="admin-update-user.php">
                <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                <table class="decorated" id="editForm">
                    <tr>
                        <th><?= Lang::getText('pseudo'); ?></th>
                        <td><input type="text" name="pseudo" value="<?= $user['pseudo'] ?>" required/></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('email'); ?></th>
                        <td><input type="mail" name="email" value="<?= $user['email'] ?>" required/></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('password'); ?></th>
                        <td><input type="password" name="password" required/></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('type'); ?></th>
                        <td colspan="2">
                            <select name="type" required>
                                <option value="default" <?= $selectDefault ?> ><?= Lang::getText('default') ?></option>
                                <option value="admin" <?= $selectAdmin ?> ><?= Lang::getText('admin') ?></option>
                                <option value="demo" <?= $selectDemo ?> ><?= Lang::getText('demo') ?></option>
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