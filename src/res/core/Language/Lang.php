<?php

// res/php/core/Language/Lang.php

namespace Language;

class Lang
{
    private static $region;
    private static $module;
    private static $section;

    public static function init($region = null)
    {
        if(!is_null($region))
            self::$setRegion($region);
    }

    public static function setRegion($region)
    {
        // Check if the folder for the region exists
        if(is_dir('res/translations/'.self::$region))
            self::$region = $region;
        else if(is_dir('../translations/'.self::$region))
            self::$region = $region;
        else
            throw new \Exception("[Lang::setRegion] The translation folder '$region' doesn't exists");
    }

    public static function setModule($module)
    {
        self::$module = $module;
    }
    
    private static function getFilePath()
    {
        $file = 'res/translations/'.self::$region.'/'.self::$module.'.ini';
        if(!file_exists($file))
            $file = '../translations/'.self::$region.'/'.self::$module.'.ini';
        return $file;
    }

    public static function setSection($section)
    {
        $file = self::getFilePath();
        $ini = parse_ini_file($file, true);
        
        if(!isset($ini[$section]))
            throw new \Exception("[Lang::setSection] Section '$section' doesn't exists");
        
        self::$section = $section;
    }

    public static function getText($keyName, $args = null)
    {
        $file = self::getFilePath();
        $s = self::$section;
        $m = self::$module;
        $ini;
        
        if($s != '')
        {
            $ini = parse_ini_file($file, true);
            $ini = $ini[self::$section];
        }
        else
            $ini = parse_ini_file($file, false);
        
        if(!isset($ini[$keyName]))
            throw new \Exception("[Lang::getText] The key '$keyName' doesn't exists at the module '$m'");
        $translation = $ini[$keyName];
        
        $str = $translation;
        
        if(!is_null($args))
        {
            foreach ($args as $key => $value)
                $str = str_replace("%$key%", $value, $str);
        }
        
        return $str;
    }
}