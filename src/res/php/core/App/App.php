<?php

namespace App;
use Language\Translations;

class App
{
    public function __construct()
    {
        global $_CORE;
        $file = 'config/app.ini';
        if(!file_exists($file))
            $file = '../../config/app.ini';
        
        $_CORE = parse_ini_file($file);
        
        new Translations();
    }
}