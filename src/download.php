<?php 
include("res/php/core.php"); 
$lang->setSection('download');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('download'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('download'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('download'); ?>
        <script>setCurrentPage('#downloadPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/download.png);">
			<h1><?= $lang->getKey('download'); ?></h1>
		</div>
		
		<div class="page">
			<h1><?= $lang->getKey('download_app_version', array('app_name' => $_CORE['app_name'], 'app_version' => $_CORE['app_version'])); ?></h1>
			<p><?= $lang->getKey('to_download_app', array('app_name' => $_CORE['app_name'])); ?></p>
			<ul>
				<li><?= $lang->getKey('download_file_source_code'); ?></li>
				<li><?= $lang->getKey('accept_conditions',array('license_name' => $_CORE['license_name'])); ?></li>
			</ul>
			
			<input type="submit" value="<?= $lang->getKey('read_license',array('license_name' => $_CORE['license_name'])); ?>" onclick="window.open('<?= $lang->getKey('license_link'); ?>', '_blank');" />
			<input type="submit" value="<?= $lang->getKey('go_to_github',array('app_name' => $_CORE['app_name'])); ?>" onclick="window.open('https://github.com/Doocode/Doosearch', '_blank');" />
		</div>
    </body>
</html>