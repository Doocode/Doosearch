<?php 
include("res/php/core.php"); 
$lang->setSection('about');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('about'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/about.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('about'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('about'); ?>
        <script>setCurrentPage('#aboutPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/about.png);">
			<h1><?= $lang->getKey('about'); ?></h1>
		</div>
		
		<div class="page">
            <?php
            $app_name = $_CORE['app_name'];
            $app_version = $_CORE['app_version'];
            $license_name = $_CORE['license_name'];
            $organisation_name = $_CORE['organisation_name'];
            $organisation_url = $_CORE['organisation_url'];
            $license_url = "https://www.gnu.org/licenses/gpl.html";
            ?>
            
			<img id="pub" src="res/img/ident.png" />
            <h1><?= $lang->getKey('about_app', array('app_name' => $app_name)); ?></h1>
            
            <h2 id="version"><?= $lang->getKey('version_number', array('app_version' => $app_version)); ?></h2>
            <p><?= $lang->getKey('app_description', array('app_name' => $app_name)); ?></p>
			
            <img src="res/img/licence-logo.png" id="licence" />
			<p>
                <?= 
                    $lang->getKey('app_license', array(
                        'app_name' => $app_name,
                        'license_name' => $license_name,
                        'license_url' => $license_url,
                        'organisation_name' => $organisation_name,
                        'organisation_url' => $organisation_url
                    )); 
                ?>
            </p>
			
            <img src="res/img/web-tech.png" id="webtech" />
            <p><?= $lang->getKey('app_uses_technologies', array('app_name' => $app_name)); ?></p>
		</div>
    </body>
</html>