<?php
include("res/php/core.php"); 
$lang->setSection('index');

$app_name = $_CORE['app_name'];
$organisation_name = $_CORE['organisation_name'];
            
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('index'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/index.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui permet de lancer une recherche sur plusieurs sites web" />
		<title><?= $lang->getKey('title_page', array('app_name' => $app_name, 'organisation_name' => $organisation_name)); ?></title>
        <script src="res/js/index.js"></script>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('index'); ?>
        <script>setCurrentPage('#homePage');</script>
		
		<div class="presentation" style="background-image: url(res/img/index.png);">
			<h1><?= $lang->getKey('home'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= $lang->getKey('welcome', array('app_name' => $app_name)); ?></h1>
            <?php $lang->setSection('hub'); ?>
            <ul id="actions">
                <li id="btnSetup">
                    <a href="setup.php">
                        <img src="res/img/start.png" />
                        <p><?= $lang->getKey('first_steps', array('app_name' => $app_name)); ?></p>
                    </a>
                </li>
                <li id="btnSearch">
                    <a href="search.php">
                        <img src="res/img/find.png" />
                        <p><?= $lang->getKey('start_searching'); ?></p>
                    </a>
                </li>
                <li id="btnQuickAccess">
                    <a href="quickaccess.php">
                        <img src="res/img/bookmarks.png" />
                        <p><?= $lang->getKey('quick_access'); ?></p>
                    </a>
                </li>
                <li id="btnConfig">
                    <a href="configuration.php">
                        <img src="res/img/config-icon.png" />
                        <p><?= $lang->getKey('configure_app', array('app_name' => $app_name)); ?></p>
                    </a>
                </li>
                <li id="btnLogin">
                    <a href="login.php">
                        <img src="res/img/user.png" />
                        <p><?= $lang->getKey('register_or_login'); ?></p>
                    </a>
                </li>
            </ul>
            
            <?php $lang->setSection('index'); ?>
            
            <div id="whatIsThis">
                <div>
                    <h2><?= $lang->getKey('what_is_app', array('app_name' => $app_name)); ?></h2>
                    <p><?= $lang->getKey('app_description', array('app_name' => $app_name)); ?></p>
                    <button onclick="window.open('https://doocode.xyz/about-doosearch.html', '_blank');"><?= $lang->getKey('learn_more'); ?></button>
                </div>
                <img src="res/img/multi-engines.png" />
            </div>
            
            <h2><?= $lang->getKey('many_search_engines_title'); ?></h2>
            <p><?= $lang->getKey('many_search_engines_text'); ?></p>
            <ul id="searchEngines">
                <?php
                    include('res/php/db.php'); // On se connecte à la BDD
                
                    $searchEngines = $tables['search_engines'];
                    $sql = "SELECT `title`,`icon` FROM `$searchEngines` ORDER BY `title` ASC";
                    $requete = $bdd->prepare($sql);
                    $requete->execute();
                    while ($donnees = $requete->fetch())
                    { 
                        ?><li title="<?= $donnees['title']; ?>"><img src="res/img/motors/<?= $donnees['icon']; ?>" /></li><?php
                    }
                ?>
            </ul>
            
            <h2><?= $lang->getKey('pin_search_engine_title'); ?></h2>
            <p><?= $lang->getKey('pin_search_engine_text'); ?></p>
            <button onclick="openWindow('#pinEngine');"><?= $lang->getKey('learn_more'); ?></button>
            
            <div id="customize">
                <img src="res/img/customize.gif" />
                <div>
                    <h2><?= $lang->getKey('customize_title'); ?></h2>
                    <p><?= $lang->getKey('customize_text'); ?></p>
                    <!--button><?= $lang->getKey('learn_more'); ?></button-->
                </div>
            </div>
            
            <div id="responsive">
                <img src="res/img/responsive-version.png" />
                <div>
                    <h2><?= $lang->getKey('responsive_title'); ?></h2>
                    <p><?= $lang->getKey('responsive_text', array('app_name' => $app_name)); ?></p>
                    <button onclick="openWindow('#qrCode');"><?= $lang->getKey('qrcode'); ?></button>
                </div>
            </div>
            
            <h2><?= $lang->getKey('made_in_france_title'); ?></h2>
            <p><?= $lang->getKey('made_in_france_text_1', array('app_name' => $app_name)); ?></p>
            <p><?= $lang->getKey('made_in_france_text_2', array('app_name' => $app_name)); ?></p>
            <a href="https://doosearch.sielo.app/"><button><?= $lang->getKey('derived_version'); ?></button></a>
		</div>
        
        <?php include('res/php/index.php'); ?>
    </body>
</html>