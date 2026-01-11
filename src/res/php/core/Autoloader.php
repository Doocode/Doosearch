<?php

// Source : https://www.grafikart.fr/forum/topics/15553

namespace Core;

class Autoloader{

    public static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class) {
        $parts = preg_split('#\\\#', $class); // we explode $class by \
        $className = array_pop($parts); // and we keep the last element

        // we create a path to the class and
        // we use DS because it's more clean and
        // it have better portability between differents systems (Windows, Linux)
        $path = implode(DS, $parts);
        $file = $className.'.php';

        $filepath = ROOT.$path.DS.$file;

        //var_dump($filepath);
        
        require $filepath;
    }

}