<?php 

// src/admin.php

//use Admin\SearchEngine;

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
            [\w]     contains all char possible (a-z A-Z 0-9)
            []+      must contains 1 or + of the interval
            ()       keep string matched as a variable
        */
        $regex = '/^([a-z]+)-([a-z-]+)$/';
        $matches = array();
        preg_match($regex, $_GET['page'], $matches);
        $action = $matches[1];
        $section = $matches[2];
        
        $controller = '';
        switch($section)
        {
            case 'search-engine':
                $controller = 'Admin\SearchEngine';
                break;
            case 'page':
                $controller = 'Admin\Page';
                break;
            case 'board':
                $controller = 'Admin\Board';
                break;
        }
        
        switch($action)
        {
            case 'add':
                $status = $controller::execute($action, $_POST);
                $data = serialize($status);
                header('Location: admin-list-'.$section.'.php?status='.urlencode($data));
                break;
            case 'edit':
                include('res/views/admin/' . $matches[2] . '/' . $action . '.php');
                break;
            case 'remove':
            case 'update':
            case 'enable':
            case 'disable':
                $status;
                if(isset($_GET['id']))
                    $status = $controller::execute($action, $_GET);
                else if(isset($_POST['id']))
                    $status = $controller::execute($action, $_POST);
                $data = serialize($status);
                header('Location: admin-list-'.$section.'.php?status='.urlencode($data));
                break;
            default:
                include('res/views/admin/' . $matches[2] . '/' . $action . '.php');
        }
    }
    else
        include("res/views/admin/index.php");
} 