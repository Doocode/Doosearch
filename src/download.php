<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setModule('download');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setModule('download'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getText('download'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('download'); ?>
        <script>setCurrentPage('#downloadPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/download.png);">
			<h1><?= Lang::getText('download'); ?></h1>
		</div>
		
		<div class="page">
			<h1><?= Lang::getText('download_app_version', array('app_name' => $_APP['app_name'], 'app_version' => $_APP['app_version'])); ?></h1>
			<p><?= Lang::getText('to_download_app', array('app_name' => $_APP['app_name'])); ?></p>
			<ul>
				<li><?= Lang::getText('download_file_source_code'); ?></li>
				<li><?= Lang::getText('accept_conditions',array('license_name' => $_APP['license_name'])); ?></li>
			</ul>
			
			<input type="submit" value="<?= Lang::getText('read_license',array('license_name' => $_APP['license_name'])); ?>" onclick="window.open('<?= Lang::getText('license_link'); ?>', '_blank');" />
			<input type="submit" value="<?= Lang::getText('go_to_github',array('app_name' => $_APP['app_name'])); ?>" onclick="window.open('https://github.com/Doocode/Doosearch', '_blank');" />
		</div>
    </body>
</html>