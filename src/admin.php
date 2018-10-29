<?php 

// src/admin.php

use Admin\SearchEngine;

include("res/php/core.php"); 

if($_SESSION['user_type'] != 'admin')
    header('Location: account.php');
else
{
    if(isset($_GET['page']))
    {
        /*
            LEGEND
            /        delimit regex in php
            ^        start
            $        ending
            [a-z]    contains chars between a & z (case sensitive)
            []+      must contains 1 or + of the interval
            ()       keep string matched as a variable
        */
        $regex = '/^([a-z]+)-([a-z-]+)$/';
        $matches = array();
        preg_match($regex, $_GET['page'], $matches);
        $action = $matches[1];
        
        switch($action)
        {
            case 'add':
                include SearchEngine::execute($action, $_POST);
                break;
            case 'edit':
            case 'remove':
            case 'update':
                if(isset($_GET['id']))
                    include SearchEngine::execute($action, $_GET);
                else if(isset($_POST['id']))
                    include SearchEngine::execute($action, $_POST);
                break;
            default:
                include('res/views/admin/' . $matches[2] . '/' . $action . '.php');
        }
    }
    else
        include("res/views/admin/index.php");
} 