<?php

// res/php/core/Language/Lang.php

namespace Language;

class Lang
{
    private static $section;
    private static $fileName;

    public static function init($section = null)
    {
        if(!is_null($section))
            self::$setSection($section);
    }

    public static function setFile(string $fileName)
    {
        self::$fileName = 'res/translations/'.$fileName;
        if(!file_exists(self::$fileName))
            self::$fileName = '../translations/'.$fileName;
    }

    public static function setSection(string $section)
    {
        $ini = parse_ini_file(self::$fileName, true);
        
        if(!isset($ini[$section]))
            throw new \Exception("[Lang::setSection] Section '$section' doesn't exists");
        
        self::$section = $section;
    }

    public static function getKey($keyName, $args = null)
    {
        $ini = parse_ini_file(self::$fileName, true);
        $section = $ini[self::$section];
        $s = self::$section;
        
        if(!isset($section[$keyName]))
            throw new \Exception("[Lang::getKey] The key '$keyName' doesn't exists at the section '$s'");
        $translation = $section[$keyName];
        
        $str = $translation;
        
        if(!is_null($args))
        {
            foreach ($args as $key => $value)
                $str = str_replace("%$key%", $value, $str);
        }
        
        return $str;
    }
}