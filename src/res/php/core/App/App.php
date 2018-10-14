<?php

namespace App;
use Language\Translations;

class App
{
    public function __construct()
    {
        global $_APP;
        $file = 'config/app.ini';
        if(!file_exists($file))
            $file = '../../config/app.ini';
        
        $_APP = parse_ini_file($file);
        
        Translations::init();
    }
}