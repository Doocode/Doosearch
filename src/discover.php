<?php 
include("res/php/core.php"); 
$lang->setSection('discover');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('discover'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/discover.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('discover'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('discover'); ?>
        <script>setCurrentPage('#discoverPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/discover.png);">
			<h1><?= $lang->getKey('discover'); ?></h1>
		</div>
		
		<div class="page">
			<h1><?= $lang->getKey('under_development'); ?></h1>
			<p><?= $lang->getKey('come_later'); ?></p>
		</div>
    </body>
</html>