<?php 
use Language\Lang;
use Board\Board;

if($_SESSION['user_type'] != 'admin')
    header('Location: account.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('administration'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/actions.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getKey('administration'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('administration'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getKey('administration'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= Lang::getKey('administration'); ?></h1>
            <ul class="actions">
                <?php Board::getActions('admin', true); ?>
            </ul>
		</div>
    </body>
</html>