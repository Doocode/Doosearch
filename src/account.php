<?php 
include("res/php/core.php");

use Account\Account;
use Language\Lang;

if(!isset($_SESSION['user_name']))
    header("Location: login.php");

Lang::setModule('date');

$jours = array(Lang::getText('sunday'), 
               Lang::getText('monday'), 
               Lang::getText('tuesday'), 
               Lang::getText('wednesday'), 
               Lang::getText('thursday'), 
               Lang::getText('friday'), 
               Lang::getText('sunday'));
$mois = array(1  => Lang::getText('january'),
              2  => Lang::getText('february'),
              3  => Lang::getText('march'),
              4  => Lang::getText('april'),
              5  => Lang::getText('may'),
              6  => Lang::getText('june'),
              7  => Lang::getText('july'),
              8  => Lang::getText('august'),
              9  => Lang::getText('september'),
              10 => Lang::getText('october'),
              11 => Lang::getText('november'),
              12 => Lang::getText('december'));

Lang::setModule('my_account');

function index($args = array())
{
    global $_APP;
    $email = Account::getEmail($_SESSION['user_name']);
    $type = '';
    switch($_SESSION['user_type'])
    {
        case 'admin':
            $type = Lang::getText('admin');
            break;
        case 'demo':
            $type = Lang::getText('demo');
            break;
        case 'default':
            $type = Lang::getText('user');
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
    $args = array();
    switch($action)
    {
        case 'details-connections':
            include('res/views/account/connections.php');
            break;
        case 'change_login':
            $res = Account::changeLogin($_SESSION['user_name'], $_POST['new_login'], $_POST['password']);
            
            switch($res)
            {
                case Account::INVALID_LOGIN:
                    $args['error'] = Lang::getText('invalid_password');
                    break;
                case Account::DISABLED_ACCOUNT:
                    $args['error'] = Lang::getText('disabled_account');
                    break;
                case Account::LOGIN_EXISTS:
                    $args['error'] = Lang::getText('login_already_taken');
                    break;
                case Account::SUCCESS:
                    $args['success'] = Lang::getText('successful_modification');
                    break;
            }
            
            index($args);
            break;
        case 'change_email':
            $res = Account::changeEmail($_SESSION['user_name'], $_POST['new_email'], $_POST['password']);
            
            switch($res)
            {
                case Account::INVALID_LOGIN:
                    $args['error'] = Lang::getText('invalid_password');
                    break;
                case Account::DISABLED_ACCOUNT:
                    $args['error'] = Lang::getText('disabled_account');
                    break;
                case Account::EMAIL_EXISTS:
                    $args['error'] = Lang::getText('email_already_taken');
                    break;
                case Account::SUCCESS:
                    $args['success'] = Lang::getText('successful_modification');
                    break;
            }
            
            index($args);
            break;
        case 'change_password':
            if($_POST['new_password1'] != $_POST['new_password2'])
                $res = Account::PASSWORD_DONT_MATCH;
            else
                $res = Account::changePassword($_SESSION['user_name'], $_POST['new_password1'], $_POST['old_password']);
            
            switch($res)
            {
                case Account::INVALID_LOGIN:
                    $args['error'] = Lang::getText('invalid_password');
                    break;
                case Account::DISABLED_ACCOUNT:
                    $args['error'] = Lang::getText('disabled_account');
                    break;
                case Account::PASSWORD_DONT_MATCH:
                    $args['error'] = Lang::getText('password_dont_match');
                    break;
                case Account::PASSWORD_DONT_MATCH:
                    $args['error'] = Lang::getText('min_length_password_not_reached');
                    break;
                case Account::SUCCESS:
                    $args['success'] = Lang::getText('successful_modification');
                    break;
            }
            
            index($args);
            break;
        default:
        {
            $args['error'] = Lang::getText('action_not_supported');
            index($args);
        }
    }
}
else
{
    index();
}