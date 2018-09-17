<?php

namespace Language;

class Lang
{
    private $section;
    private $fileName;

    public function __construct($section = null)
    {
        if(!is_null($section))
            $this->setSection($section);
    }

    public function setFile(string $fileName)
    {
        $this->fileName = 'res/translations/'.$fileName;
        if(!file_exists($this->fileName))
            $this->fileName = '../translations/'.$fileName;
    }

    public function setSection(string $section)
    {
        $ini = parse_ini_file($this->fileName, true);
        
        if(!isset($ini[$section]))
            throw new \Exception('[Lang] {getKey} => Section doesn\'t exists');
        
        $this->section = $section;
    }

    public function getKey($keyName, $args = null)
    {
        $ini = parse_ini_file($this->fileName, true);
        $section = $ini[$this->section];
        $s = $this->section;
        
        if(!isset($section[$keyName]))
            throw new \Exception("[Lang] {getKey} => The key [$s]->($keyName) doesn't exists");
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