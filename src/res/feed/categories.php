<?php

use Language\Lang;

include("../core/Core.php"); 

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

$table = $ini['tables']['categories'];
$sql = "SELECT * FROM `$table` WHERE `status`='enabled' ORDER BY `keyword` ASC";
$requete = $bdd->prepare($sql);
$requete->execute();
$listCategories = array();

$id = 1;
Lang::setModule('categories');
while ($row = $requete->fetch())
{ 
    $data = array();
    $data['id'] = $id;
    $data['keyword'] = $row['keyword'];
    $data['text'] = Lang::getText($row['keyword']);
    $listCategories[] = $data;
    $id++;
}
$requete->closeCursor();

array_multisort(array_column($listCategories, 'text'), SORT_ASC, $listCategories);

echo json_encode($listCategories);