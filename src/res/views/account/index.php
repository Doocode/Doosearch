<?php 

use Gui\Window;
use Language\Lang;

$last_connections = getLastConnections(3);
Lang::setSection('my_account');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('my_account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getKey('my_account'); ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('my_account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getKey('my_account'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= Lang::getKey('my_account'); ?></h1>
            <?php if(isset($args['error'])) { ?>
            <p class="info red"><?= $args['error'] ?></p>
            <?php } else if(isset($args['success'])) { ?>
            <p class="info green"><?= $args['success'] ?></p>
            <?php } ?>
            <table id="ident">
                <tr>
                    <td colspan="3"><img src="res/img/profile.png" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('login'); ?></th>
                    <td><?= $_SESSION['user_name'] ?></td>
                    <td><button onclick="openWindow('#loginEditor')"><?= Lang::getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('email'); ?></th>
                    <td><?= $email ?></td>
                    <td><button onclick="openWindow('#emailEditor')"><?= Lang::getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('password'); ?></th>
                    <td>********</td>
                    <td><button onclick="openWindow('#passwordEditor')"><?= Lang::getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('account_type'); ?></th>
                    <td><?= $type ?></td>
                    <td><button class="disabled"><?= Lang::getKey('edit'); ?></button></td>
                </tr>
            </table>
            
            <h1><?= Lang::getKey('last_connections'); ?></h1>
            <?php
            if(sizeof($last_connections) > 0)
            {
            ?>
            
            <table id="listConnections">
                <tr>
                    <th>#</th>
                    <th><?= Lang::getKey('date'); ?></th>
                    <th><?= Lang::getKey('time'); ?></th>
                    <th><?= Lang::getKey('ip'); ?></th>
                    <th><?= Lang::getKey('user_agent'); ?></th>
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
                
            <a href="?action=details-connections"><button><?= Lang::getKey('see_more'); ?></button></a>
            <?php
            }
            else
            {
                ?><p class="info"><?= Lang::getKey('no_data_to_display'); ?></p><?php
            }
            ?>
		</div>
        
        
        
        
        <?php ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_login">
            <table>
                <tr>
                    <th><?= Lang::getKey('current_login'); ?></th>
                    <td><input type="text" value="<?= $_SESSION['user_name'] ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('new_login'); ?></th>
                    <td><input type="text" name="new_login" value="<?= $_SESSION['user_name'] ?>"></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('current_password') ?></th>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getKey('submit'); ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window(Lang::getKey('edit_login'), 'loginEditor', ob_get_clean());
        $loginEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_email">
            <table>
                <tr>
                    <th><?= Lang::getKey('current_email') ?></th>
                    <td><input type="mail" value="<?= $email ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('new_email') ?></th>
                    <td><input type="mail" name="new_email"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getKey('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $emailEditor = new Window(Lang::getKey('change_email'), 'emailEditor', ob_get_clean());
        $emailEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_password">
            <table>
                <tr>
                    <th><?= Lang::getKey('current_password') ?></th>
                    <td><input type="password" name="old_password"></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('new_password') ?></th>
                    <td><input type="password" name="new_password1"></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey('new_password_2') ?></th>
                    <td><input type="password" name="new_password2"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= Lang::getKey('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $passwordEditor = new Window(Lang::getKey('change_password'), 'passwordEditor', ob_get_clean());
        $passwordEditor->toHtml();
        ?>
    </body>
</html>