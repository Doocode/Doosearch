<?php

// src/res/php/core/Account/Account.php

namespace Account;

class Account
{
    const MIN_LENGTH_LOGIN = 2;
    const MIN_LENGTH_PASSWORD = 8;
    
    const SUCCESS = 0;
    
    const EMAIL_EXISTS = -1;
    const LOGIN_EXISTS = -2;
    const PASSWORD_DONT_MATCH = -3;
    const MIN_LENGTH_LOGIN_NOT_REACHED = -4;
    const MIN_LENGTH_PASSWORD_NOT_REACHED = -5;
    
    const INVALID_LOGIN = -10;
    const UNKNOWN_ACCOUNT = -11;
    const DISABLED_ACCOUNT = -12;
    
    public static function register($email, $login, $password1, $password2)
    {
        // Check if all conditions are validated
        if($password1 != $password2)                        // If the passwords don't match
            return self::PASSWORD_DONT_MATCH;
        if(strlen($password1) < self::MIN_LENGTH_PASSWORD)  // If the minimum password size is not reached
            return self::MIN_LENGTH_PASSWORD_NOT_REACHED;
        if(strlen($login) < self::MIN_LENGTH_LOGIN)         // If the minimum login size is not reached
            return self::MIN_LENGTH_LOGIN_NOT_REACHED;
        if(self::userExists($email))                        // If there is a user with this email
            return self::EMAIL_EXISTS;
        if(self::userExists($login))                        // If there is a user with this login
            return self::LOGIN_EXISTS;
        
        // Insert user into database
        include('res/php/db.php');
        $users = $tables['users'];
        $sql = "INSERT INTO `$users` VALUES (NULL,?,?,?,?,?,CURRENT_DATE(),CURRENT_TIME());";
        $requete = $bdd->prepare($sql);
        $requete->execute(array($login, $email, password_hash($password1, PASSWORD_BCRYPT), 'default', 'enabled'));
        $requete->closeCursor();
        
        // Login user
        $res = self::login($login, $password1);
        echo $res;
        return $res;
    }
    
    public static function login($login, $password)
    {
        // Wait 2s to reduce attacks by brute force
        sleep(2);
        
        // Login to database
        require('res/php/db.php');
        
        // Chech if user exists
        if(!self::userExists($login))
            return self::UNKNOWN_ACCOUNT;

        // Get data
        $users = $ini['tables']['users'];
        $sql = "SELECT id, pseudo, email, password, type, status
                FROM `$users`";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        while($data = $req->fetch())
        {
            // If login exist
            if($login == $data['pseudo'] || $login == $data['email'])
                break;
        }
        $req->closeCursor();
        
        // If password do not match
        if(!password_verify($password, $data['password']))
            return self::INVALID_LOGIN;
        
        // If the account is disabled
        if($data == 'disabled')
            return self::DISABLED_ACCOUNT;
        
        // Login success
        self::updateHistory($data['id']);
        $_SESSION['user_name'] = $data['pseudo'];
        $_SESSION['user_type'] = $data['type'];
        
        header('Location: account.php');
        
        return self::SUCCESS;
    }
    
    private static function userExists($login)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $users = $tables['users'];
        $sql = "SELECT pseudo, email, status
                FROM `$users`";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        $userExists = false;
        while($data = $req->fetch())
        {
            // If login exist
            if($login == $data['pseudo'] || $login == $data['email'])
            {
                $userExists = true;
                break;
            }
        }
        $req->closeCursor();
        
        // Return
        return $userExists;
    }
    
    private static function updateHistory($id)
    {
        // Get some user agent and ip
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $ip = '';
        if(getenv('HTTP_CLIENT_IP'))
            $ip = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ip = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ip = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ip = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ip = getenv('REMOTE_ADDR');
        else
            $ip = 'UNKNOWN';
        
        // Login to database
        require('res/php/db.php');

        // Insert data
        $history = $ini['tables']['users_connexions'];
        $sql = "INSERT INTO `$history`
                VALUES (NULL, ?, CURRENT_DATE(), CURRENT_TIME(), ?, ?)";
        $req = $bdd->prepare($sql);
        $req->execute(array($id, $ip, $user_agent));
    }
    
    public static function getEmail($login)
    {
        // Login to database
        require('res/php/db.php');

        // Get data
        $users = $tables['users'];
        $sql = "SELECT email
                FROM `$users`
                WHERE pseudo = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($login));
        
        // Fetching data
        $email = '';
        while($data = $req->fetch())
        {
            // If login exist
            $email = $data['email'];
            break;
        }
        $req->closeCursor();
        
        // Return
        return $email;
    }
    
    public static function checkPassword($login, $password)
    {
        // Wait 2s to reduce attacks by brute force
        sleep(2);
        
        // Login to database
        require('res/php/db.php');

        // Get data
        $users = $ini['tables']['users'];
        $sql = "SELECT pseudo, email, password
                FROM `$users`";
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // Fetching data
        while($data = $req->fetch())
        {
            // If login exist
            if($login == $data['pseudo'] || $login == $data['email'])
                break;
        }
        $req->closeCursor();
        
        // If password do not match
        if(!password_verify($password, $data['password']))
            return self::INVALID_LOGIN;
        
        // If the account is disabled
        if($data == 'disabled')
            return self::DISABLED_ACCOUNT;
        
        // Success
        return self::SUCCESS;
    }
    
    public static function changeLogin($currentLogin, $newLogin, $password)
    {
        // Check password
        $res = self::checkPassword($currentLogin, $password);
        if($res != self::SUCCESS)
            return $res;
        
        // Check if login is available
        if(self::userExists($newLogin))
            return self::LOGIN_EXISTS;
        
        // Login to database
        require('res/php/db.php');

        // Update data
        $table = $ini['tables']['users'];
        $sql = "UPDATE `$table`
                SET pseudo = ?
                WHERE pseudo = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($newLogin, $currentLogin));
        
        $_SESSION['user_name'] = $newLogin;
        
        return self::SUCCESS;
    }
    
    public static function changeEmail($currentLogin, $newEmail, $password)
    {
        // Check password
        $res = self::checkPassword($currentLogin, $password);
        if($res != self::SUCCESS)
            return $res;
        
        // Check if email is available
        if(self::userExists($newEmail))
            return self::EMAIL_EXISTS;
        
        // Login to database
        require('res/php/db.php');

        // Update data
        $table = $ini['tables']['users'];
        $sql = "UPDATE `$table`
                SET email = ?
                WHERE pseudo = ?";
        $req = $bdd->prepare($sql);
        $req->execute(array($newEmail, $currentLogin));
        
        return self::SUCCESS;
    }
}