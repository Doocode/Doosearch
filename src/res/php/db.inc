<?php
$config = parse_ini_file('config/db.ini');

// Connexion à la base de données
try
{
    $host = $config['host'];
    $database = $config['database'];
    $bdd = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $config['user'], $config['pass']);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>