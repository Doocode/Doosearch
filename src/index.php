<?php
include("res/php/core.php"); 
use Language\Lang;
Lang::setModule('index');

$app_name = $_APP['app_name'];
$organisation_name = $_APP['organisation_name'];
            
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setModule('index'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/actions.css" />
        <link rel="stylesheet" href="res/css/index.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
		<meta name="keywords" content="doocode, doosearch" />
		<meta name="description" content="Doosearch est une page d'accueil qui permet de lancer une recherche sur plusieurs sites web" />
		<title><?= Lang::getText('title_page', array('app_name' => $app_name, 'organisation_name' => $organisation_name)); ?></title>
        <script src="res/js/index.js"></script>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('index'); ?>
        <script>setCurrentPage('#homePage');</script>
		
		<div class="presentation" style="background-image: url(res/img/index.png);">
			<h1><?= Lang::getText('home'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= Lang::getText('welcome', array('app_name' => $app_name)); ?></h1>
            <?php Lang::setModule('hub'); ?>
            <ul class="actions">
                <li id="btnSetup">
                    <a href="setup.php">
                        <img src="res/img/start.png" />
                        <p><?= Lang::getText('first_steps', array('app_name' => $app_name)); ?></p>
                    </a>
                </li>
                <li id="btnSearch">
                    <a href="search.php">
                        <img src="res/img/find.png" />
                        <p><?= Lang::getText('start_searching'); ?></p>
                    </a>
                </li>
                <li id="btnQuickAccess">
                    <a href="quickaccess.php">
                        <img src="res/img/bookmarks.png" />
                        <p><?= Lang::getText('quick_access'); ?></p>
                    </a>
                </li>
                <li id="btnConfig">
                    <a href="configuration.php">
                        <img src="res/img/config-icon.png" />
                        <p><?= Lang::getText('configure_app', array('app_name' => $app_name)); ?></p>
                    </a>
                </li>
                <?php if(!isset($_SESSION['user_name'])) { ?>
                <li id="btnLogin">
                    <a href="login.php">
                        <img src="res/img/user.png" />
                        <p><?= Lang::getText('register_or_login'); ?></p>
                    </a>
                </li>
                <?php } else { ?>
                <li id="btnLogin">
                    <a href="account.php">
                        <img src="res/img/user.png" />
                        <p><?= Lang::getText('my_account'); ?></p>
                    </a>
                </li>
                <?php } ?>
            </ul>
            
            <?php Lang::setModule('index'); ?>
            
            <div id="whatIsThis">
                <div>
                    <h2><?= Lang::getText('what_is_app', array('app_name' => $app_name)); ?></h2>
                    <p><?= Lang::getText('app_description', array('app_name' => $app_name)); ?></p>
                    <button onclick="window.open('https://doocode.xyz/about-doosearch.html', '_blank');"><?= Lang::getText('learn_more'); ?></button>
                </div>
                <img src="res/img/multi-engines.png" />
            </div>
            
            <h2><?= Lang::getText('many_search_engines_title'); ?></h2>
            <p><?= Lang::getText('many_search_engines_text'); ?></p>
            <ul id="searchEngines">
                <?php
                    include('res/php/db.php'); // On se connecte à la BDD
                
                    $searchEngines = $tables['search_engines'];
                    $sql = "SELECT `title`,`icon` FROM `$searchEngines` WHERE `status`='enabled' ORDER BY `title` ASC";
                    $requete = $bdd->prepare($sql);
                    $requete->execute();
                    while ($donnees = $requete->fetch())
                    { 
                        ?><li title="<?= $donnees['title']; ?>"><img src="res/img/motors/<?= $donnees['icon']; ?>" /></li><?php
                    }
                ?>
            </ul>
            
            <h2><?= Lang::getText('pin_search_engine_title'); ?></h2>
            <p><?= Lang::getText('pin_search_engine_text'); ?></p>
            <button onclick="openWindow('#pinEngine');"><?= Lang::getText('learn_more'); ?></button>
            
            <div id="customize">
                <img src="res/img/customize.gif" />
                <div>
                    <h2><?= Lang::getText('customize_title'); ?></h2>
                    <p><?= Lang::getText('customize_text'); ?></p>
                    <!--button><?= Lang::getText('learn_more'); ?></button-->
                </div>
            </div>
            
            <div id="responsive">
                <img src="res/img/responsive-version.png" />
                <div>
                    <h2><?= Lang::getText('responsive_title'); ?></h2>
                    <p><?= Lang::getText('responsive_text', array('app_name' => $app_name)); ?></p>
                    <button onclick="openWindow('#qrCode');"><?= Lang::getText('qrcode'); ?></button>
                </div>
            </div>
            
            <h2><?= Lang::getText('made_in_france_title'); ?></h2>
            <p><?= Lang::getText('made_in_france_text_1', array('app_name' => $app_name)); ?></p>
            <p><?= Lang::getText('made_in_france_text_2', array('app_name' => $app_name)); ?></p>
            <a href="https://doosearch.sielo.app/"><button><?= Lang::getText('derived_version'); ?></button></a>
		</div>
        
        <?php include('res/php/index.php'); ?>
    </body>
</html>