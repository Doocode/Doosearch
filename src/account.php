<?php 
include("res/php/core.php");

use Account\Account;
use Language\Lang;

if(!isset($_SESSION['user_name']))
    header("Location: login.php");

Lang::setSection('date');

$jours = array(Lang::getKey('sunday'), 
               Lang::getKey('monday'), 
               Lang::getKey('tuesday'), 
               Lang::getKey('wednesday'), 
               Lang::getKey('thursday'), 
               Lang::getKey('friday'), 
               Lang::getKey('sunday'));
$mois = array(1  => Lang::getKey('january'),
              2  => Lang::getKey('february'),
              3  => Lang::getKey('march'),
              4  => Lang::getKey('april'),
              5  => Lang::getKey('may'),
              6  => Lang::getKey('june'),
              7  => Lang::getKey('july'),
              8  => Lang::getKey('august'),
              9  => Lang::getKey('september'),
              10 => Lang::getKey('october'),
              11 => Lang::getKey('november'),
              12 => Lang::getKey('december'));

Lang::setSection('my_account');

function index($args = array())
{
    global $_APP;
    $email = Account::getEmail($_SESSION['user_name']);
    $type = '';
    switch($_SESSION['user_type'])
    {
        case 'admin':
            $type = Lang::getKey('admin');
            break;
        case 'demo':
            $type = Lang::getKey('demo');
            break;
        case 'default':
            $type = Lang::getKey('user');
            break;
    }
    include('res/views/account/index.php');
}

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
    // Get action
    $action;
    if(isset($_GET['action']))
        $action = $_GET['action'];
    else 
        $action = $_POST['action'];
    
    // Exec action
    switch($action)
    {
        case 'details-connections':
            include('res/views/account/connections.php');
            break;
        case 'change_login':
            $res = Account::changeLogin($_SESSION['user_name'], $_POST['new_login'], $_POST['password']);
            $args = array();
            
            switch($res)
            {
                case Account::INVALID_LOGIN:
                    $args['error'] = Lang::getKey('invalid_password');
                    break;
                case Account::DISABLED_ACCOUNT:
                    $args['error'] = Lang::getKey('disabled_account');
                    break;
                case Account::LOGIN_EXISTS:
                    $args['error'] = Lang::getKey('login_already_taken');
                    break;
                case Account::SUCCESS:
                    $args['success'] = Lang::getKey('successful_modification');
                    break;
            }
            
            index($args);
            break;
        case 'change_email':
            $res = Account::changeEmail($_SESSION['user_name'], $_POST['new_email'], $_POST['password']);
            $args = array();
            
            switch($res)
            {
                case Account::INVALID_LOGIN:
                    $args['error'] = Lang::getKey('invalid_password');
                    break;
                case Account::DISABLED_ACCOUNT:
                    $args['error'] = Lang::getKey('disabled_account');
                    break;
                case Account::EMAIL_EXISTS:
                    $args['error'] = Lang::getKey('email_already_taken');
                    break;
                case Account::SUCCESS:
                    $args['success'] = Lang::getKey('successful_modification');
                    break;
            }
            
            index($args);
            break;
        default:
        {
            $error = Lang::getKey('action_not_supported');
            index(array('error' => $error));
        }
    }
}
else
{
    index();
}