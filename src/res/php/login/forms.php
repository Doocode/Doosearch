<?php use Account\Account; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/login.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('account'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= $lang->getKey('account'); ?></h1>
		</div>
		
		<div class="page">
			<h1 id="login"><?= $lang->getKey('login'); ?></h1>
            <?php
            if(isset($_POST['action']) && isset($status) && $_POST['action'] == 'login')
            {
                switch($status)
                {
                    case Account::INVALID_LOGIN:
                        $msg = $lang->getKey('invalid_login_or_password');
                        break;
                    case Account::UNKNOWN_ACCOUNT:
                        $msg = $lang->getKey('unknown_account');
                        break;
                    case Account::DISABLED_ACCOUNT:
                        $msg = $lang->getKey('disabled_account');
                        break;
                }
                ?>
                    <p class="info red"><?= $msg; ?></p>
                <?php
            }
            ?>
            <form method="post">
                <input type="hidden" name="action" value="login" />
                <table>
                    <tr>
                        <th><?= $lang->getKey('login_or_email'); ?></th>
                        <td><input type="text" name="login" required/></td>
                    </tr>
                    <tr>
                        <th><?= $lang->getKey('password'); ?></th>
                        <td><input type="password" name="password" required/></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="<?= $lang->getKey('confirm'); ?>"/></td>
                    </tr>
                </table>
            </form>
            
			<h1 id="register"><?= $lang->getKey('register'); ?></h1>
            <?php
            $email = ''; 
            $login = '';
            if(isset($_POST['action']) && isset($status) && $_POST['action'] == 'register')
            {
                $msg = '';
                switch($status)
                {
                    case Account::PASSWORD_DONT_MATCH:
                        $msg = $lang->getKey('password_dont_match');
                        break;
                    case Account::MIN_LENGTH_PASSWORD_NOT_REACHED:
                        $msg = $lang->getKey('min_length_password_not_reached');
                        break;
                    case Account::MIN_LENGTH_LOGIN_NOT_REACHED:
                        $msg = $lang->getKey('min_length_login_not_reached');
                        break;
                    case Account::EMAIL_EXISTS:
                        $msg = $lang->getKey('email_exists');
                        break;
                    case Account::LOGIN_EXISTS:
                        $msg = $lang->getKey('login_exists');
                        break;
                }
                $email = $_POST['email'];
                $login = $_POST['login'];
                ?>
                    <p class="info red"><?= $msg; ?></p>
                <?php
            }
            ?>
            <form method="post">
                <input type="hidden" name="action" value="register" />
                <table>
                    <tr>
                        <th><?= $lang->getKey('pseudo'); ?></th>
                        <td><input type="text" name="login" value="<?= $login; ?>" required/></td>
                    </tr>
                    <tr>
                        <th><?= $lang->getKey('email'); ?></th>
                        <td><input type="mail" name="email" value="<?= $email; ?>" required/></td>
                    </tr>
                    <tr>
                        <th><?= $lang->getKey('password'); ?></th>
                        <td><input type="password" name="password_1" required/></td>
                    </tr>
                    <tr>
                        <th><?= $lang->getKey('password_2'); ?></th>
                        <td><input type="password" name="password_2" required/></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="<?= $lang->getKey('confirm'); ?>"/></td>
                    </tr>
                </table>
            </form>
		</div>
    </body>
</html>