<?php
    echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // Récupération des paramètres
    $config = parse_ini_file('config/db.ini');

    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'].';charset=utf8', $config['user'], $config['password']);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
?>