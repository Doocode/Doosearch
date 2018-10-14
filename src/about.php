<?php 
include("res/php/core.php"); 
use Language\Lang;
Lang::setSection('about');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('about'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/about.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getKey('about'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('about'); ?>
        <script>setCurrentPage('#aboutPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/about.png);">
			<h1><?= Lang::getKey('about'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            $app_name = $_APP['app_name'];
            $app_version = $_APP['app_version'];
            $license_name = $_APP['license_name'];
            $organisation_name = $_APP['organisation_name'];
            $organisation_url = $_APP['organisation_url'];
            $license_url = "https://www.gnu.org/licenses/gpl.html";
            ?>
            
			<img id="pub" src="res/img/ident.png" />
            <h1><?= Lang::getKey('about_app', array('app_name' => $app_name)); ?></h1>
            
            <h2 id="version"><?= Lang::getKey('version_number', array('app_version' => $app_version)); ?></h2>
            <p><?= Lang::getKey('app_description', array('app_name' => $app_name)); ?></p>
			
            <img src="res/img/licence-logo.png" id="licence" />
			<p>
                <?= 
                    Lang::getKey('app_license', array(
                        'app_name' => $app_name,
                        'license_name' => $license_name,
                        'license_url' => $license_url,
                        'organisation_name' => $organisation_name,
                        'organisation_url' => $organisation_url
                    )); 
                ?>
            </p>
			
            <img src="res/img/web-tech.png" id="webtech" />
            <p><?= Lang::getKey('app_uses_technologies', array('app_name' => $app_name)); ?></p>
		</div>
    </body>
</html>