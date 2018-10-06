<?php 
include("res/php/core.php");

use Account\Account;

if(!isset($_SESSION['user_name']))
    header("Location: login.php");

$lang->setSection('date');

$jours = array($lang->getKey('sunday'), 
               $lang->getKey('monday'), 
               $lang->getKey('tuesday'), 
               $lang->getKey('wednesday'), 
               $lang->getKey('thursday'), 
               $lang->getKey('friday'), 
               $lang->getKey('sunday'));
$mois = array(1  => $lang->getKey('january'),
              2  => $lang->getKey('february'),
              3  => $lang->getKey('march'),
              4  => $lang->getKey('april'),
              5  => $lang->getKey('may'),
              6  => $lang->getKey('june'),
              7  => $lang->getKey('july'),
              8  => $lang->getKey('august'),
              9  => $lang->getKey('september'),
              10 => $lang->getKey('october'),
              11 => $lang->getKey('november'),
              12 => $lang->getKey('december'));

$lang->setSection('my_account');


function getLastConnections($limit = null)
{
    // Login to database
    require('res/php/db.php');

    // Get data
    $users = $tables['users'];
    $connexions = $tables['users_connexions'];
    $sql = "SELECT * ,
                DATE_FORMAT(date, '%w') AS day_name, 
                DATE_FORMAT(date, '%e') AS day_number,
                DATE_FORMAT(date, '%c') AS month_number, 
                DATE_FORMAT(date, '%Y') AS year
            FROM $connexions
            WHERE user = (
                SELECT id 
                FROM $users 
                WHERE pseudo = ?
            )
            ORDER BY date DESC, time DESC";
    
    if($limit != null)
    {
        $sql = $sql . " LIMIT $limit";
        $req = $bdd->prepare($sql);
        $req->execute(array($_SESSION['user_name']));
    }
    else
    {
        $req = $bdd->prepare($sql);
        $req->execute(array($_SESSION['user_name']));
    }

    // Fetching data
    $list = array();
    while($data = $req->fetch())
        $list[] = $data;
        
    $req->closeCursor();

    // Return
    return $list;
}

if(isset($_GET['action']) || isset($_POST['action']))
{
    $action;
    if(isset($_GET['action']))
        $action = $_GET['action'];
    else 
        $action = $_POST['action'];
    switch($action)
    {
        case 'details-connections':
            include('res/php/account/connections.php');
            break;
        default:
        {
            $error = $lang->getKey('action_not_supported');
            $email = Account::getEmail($_SESSION['user_name']);
            $type = '';
            switch($_SESSION['user_type'])
            {
                case 'admin':
                    $type = $lang->getKey('admin');
                    break;
                case 'demo':
                    $type = $lang->getKey('demo');
                    break;
                case 'default':
                    $type = $lang->getKey('user');
                    break;
            }
            include('res/php/account/index.php');
        }
    }
}
else
{
    $email = Account::getEmail($_SESSION['user_name']);
    $type = '';
    switch($_SESSION['user_type'])
    {
        case 'admin':
            $type = $lang->getKey('admin');
            break;
        case 'demo':
            $type = $lang->getKey('demo');
            break;
        case 'default':
            $type = $lang->getKey('user');
            break;
    }
    include('res/php/account/index.php');
}