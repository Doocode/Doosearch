<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setSection('discover');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('discover'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/discover.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getText('discover'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('discover'); ?>
        <script>setCurrentPage('#discoverPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/discover.png);">
			<h1><?= Lang::getText('discover'); ?></h1>
		</div>
		
		<div class="page">
			<h1><?= Lang::getText('under_development'); ?></h1>
			<p><?= Lang::getText('come_later'); ?></p>
		</div>
    </body>
</html>