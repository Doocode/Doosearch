<?php 

define('MAX_ROWS',15);
$last_connections = getLastConnections(MAX_ROWS);


?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php Lang::setSection('my_account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <title><?= $_APP['app_name'] .' > '. Lang::getKey('my_account'); ?></title>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setSection('my_account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getKey('my_account'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= Lang::getKey('last_connections'); ?></h1>
            <?php
            if(sizeof($last_connections) > 0)
            {
            ?>
            
            <table id="listConnections">
                <tr>
                    <th>#</th>
                    <th><?= Lang::getKey('date'); ?></th>
                    <th><?= Lang::getKey('time'); ?></th>
                    <th><?= Lang::getKey('ip'); ?></th>
                    <th><?= Lang::getKey('user_agent'); ?></th>
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
                ?><p class="info"><?= Lang::getKey('no_data_to_display'); ?></p><?php
            }
            ?>
		</div>
    </body>
</html>