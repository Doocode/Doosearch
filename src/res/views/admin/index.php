<?php 
use Language\Lang;
Lang::setSection('about');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('administration'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/actions.css" />
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
            <p><?= Lang::getKey('not_content_to_display'); ?></p>
		</div>
    </body>
</html>