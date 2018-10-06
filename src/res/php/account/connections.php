<?php 

define('MAX_ROWS',15);
$last_connections = getLastConnections(MAX_ROWS);


?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('my_account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('my_account'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('my_account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= $lang->getKey('my_account'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= $lang->getKey('last_connections'); ?></h1>
            <?php
            if(sizeof($last_connections) > 0)
            {
            ?>
            
            <table id="listConnections">
                <tr>
                    <th>#</th>
                    <th><?= $lang->getKey('date'); ?></th>
                    <th><?= $lang->getKey('time'); ?></th>
                    <th><?= $lang->getKey('ip'); ?></th>
                    <th><?= $lang->getKey('user_agent'); ?></th>
                </tr>
                
                <?php
                $th = 0;
                foreach($last_connections as $connexion)
                {
                    $th++;
                ?>
                
                <tr>
                    <th><?= $th ?></th>
                    <td><?= $connexion['date'] ?></td>
                    <td><?= $connexion['time'] ?></td>
                    <td><?= $connexion['ip'] ?></td>
                    <td><?= $connexion['user_agent'] ?></td>
                </tr>
                
                <?php } ?>
            </table>
            <?php
            }
            else
            {
                ?><p class="info"><?= $lang->getKey('no_data_to_display'); ?></p><?php
            }
            ?>
		</div>
    </body>
</html>