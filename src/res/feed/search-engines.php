<?php

// On se connecte à la BDD
$ini = parse_ini_file('../../config/db.ini', true);
$config = $ini['config'];

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'].';charset=utf8', $config['user'], $config['password']);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$table = $ini['tables']['search_engines'];
$sql = "SELECT * FROM `$table` ORDER BY `title` ASC";
$requete = $bdd->prepare($sql);
$requete->execute();
$listEngines = array();

$id = 1;
while ($row = $requete->fetch())
{ 
    $data = array();
    $data['id'] = $id;
    $data['title'] = $row['title'];
    $data['icon'] = 'res/img/motors/' . $row['icon'];
    $data['prefix'] = $row['prefix'];
    $data['suffix'] = $row['suffix'];
    $listEngines[] = $data;
    $id++;
}

echo json_encode($listEngines);