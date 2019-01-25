<?php 

use Gui\Window;
use Gui\Board;
use Language\Lang;

$last_connections = getLastConnections(3);
Lang::setModule('my_account');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setModule('my_account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/actions.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getText('my_account'); ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('my_account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('my_account'); ?></h1>
		</div>
		
		<div class="page">
            <div id="title">
                <h1><?= Lang::getText('my_account'); ?></h1>
                <div id="profile">
                    <img src="res/img/profile.png" />
                    <p><?= $_SESSION['user_name'] ?></p>
                    <button onclick="openWindow('#accountEditor')"><img src="res/img/actions/manage.png" /></button>
                </div>
            </div>
            <?php if(isset($args['error'])) { ?>
            <p class="info red"><?= $args['error'] ?></p>
            <?php } else if(isset($args['success'])) { ?>
            <p class="info green"><?= $args['success'] ?></p>
            <?php } ?>
            
            <!-- Actions -->
            <?php Lang::setModule('board'); ?>
            <!-- Default actions -->
            <ul class="actions">
                <?php Board::getActions('default', true); ?>
            </ul>
                
            <!-- Admin actions -->
            <?php if($_SESSION['user_type'] == 'admin') { ?>
            <h2><?= Lang::getText('administration'); ?></h2>
            <ul class="actions">
                <?php Board::getActions('admin', true); ?>
            </ul>
            <?php } 
            
            Lang::setModule('my_account');
            ?>
            
            <h2><?= Lang::getText('last_connections'); ?></h2>
            <?php
            if(sizeof($last_connections) > 0)
            {
            ?>
            
            <table id="listConnections">
                <tr>
                    <th>#</th>
                    <th><?= Lang::getText('date'); ?></th>
                    <th><?= Lang::getText('time'); ?></th>
                    <th><?= Lang::getText('ip'); ?></th>
                    <th><?= Lang::getText('user_agent'); ?></th>
                </tr>
                
                <?php
                $th = 0;
                foreach($last_connections as $connexion)
                {
                    $th++;
                ?>
                
                <tr>
                    <th><?= $th ?></th>
                    <td><?= $connexion['date'] ?></td>
                    <td><?= $connexion['time'] ?></td>
                    <td><?= $connexion['ip'] ?></td>
                    <td><?= $connexion['user_agent'] ?></td>
                </tr>
                
                <?php } ?>
            </table>
                
            <a href="?action=details-connections"><button><?= Lang::getText('see_more'); ?></button></a>
            <?php
            }
            else
            {
                ?><p class="info"><?= Lang::getText('no_data_to_display'); ?></p><?php
            }
            ?>
		</div>
        
        
        
        
        
        
        <?php ob_start(); ?>
        <table id="ident">
            <tr>
                <td colspan="3"><img src="res/img/profile.png" /></td>
            </tr>
            <tr>
                <th><?= Lang::getText('login'); ?></th>
                <td><?= $_SESSION['user_name'] ?></td>
                <td><button onclick="openWindow('#loginEditor')"><?= Lang::getText('edit'); ?></button></td>
            </tr>
            <tr>
                <th><?= Lang::getText('email'); ?></th>
                <td><?= $email ?></td>
                <td><button onclick="openWindow('#emailEditor')"><?= Lang::getText('edit'); ?></button></td>
            </tr>
            <tr>
                <th><?= Lang::getText('password'); ?></th>
                <td>********</td>
                <td><button onclick="openWindow('#passwordEditor')"><?= Lang::getText('edit'); ?></button></td>
            </tr>
            <tr>
                <th><?= Lang::getText('account_type'); ?></th>
                <td><?= $type ?></td>
                <td><button class="disabled"><?= Lang::getText('edit'); ?></button></td>
            </tr>
        </table>
        <?php
        $accountEditor = new Window(Lang::getText('my_account'), 'accountEditor', ob_get_clean());
        $accountEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_login">
            <table>
                <tr>
                    <th><?= Lang::getText('current_login'); ?></th>
                    <td><input type="text" value="<?= $_SESSION['user_name'] ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('new_login'); ?></th>
                    <td><input type="text" name="new_login" value="<?= $_SESSION['user_name'] ?>"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('current_password') ?></th>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit'); ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getText('edit_login'), 'loginEditor', ob_get_clean());
        $loginEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_email">
            <table>
                <tr>
                    <th><?= Lang::getText('current_email') ?></th>
                    <td><input type="mail" value="<?= $email ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('new_email') ?></th>
                    <td><input type="mail" name="new_email"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('current_password') ?></th>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $emailEditor = new Window(Lang::getText('change_email'), 'emailEditor', ob_get_clean());
        $emailEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_password">
            <table>
                <tr>
                    <th><?= Lang::getText('current_password') ?></th>
                    <td><input type="password" name="old_password"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('new_password') ?></th>
                    <td><input type="password" name="new_password1"></td>
                </tr>
                <tr>
                    <th><?= Lang::getText('new_password_2') ?></th>
                    <td><input type="password" name="new_password2"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getText('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $passwordEditor = new Window(Lang::getText('change_password'), 'passwordEditor', ob_get_clean());
        $passwordEditor->toHtml();
        ?>
    </body>
</html>