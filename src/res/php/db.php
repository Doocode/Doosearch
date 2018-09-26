<?php

// Récupération des paramètres
$ini = parse_ini_file('config/db.ini', true);
$config = $ini['config'];
$tables = $ini['tables'];

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'].';charset=utf8', $config['user'], $config['password']);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}