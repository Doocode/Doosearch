<?php

namespace Language;

class Translations
{
    public function __construct()
    {
        // We will use these following global variables
        global $_CORE, $lang;
        
        if(isset($_GET['lang']))
        {
            // Set a cookie for the language
            switch($_GET['lang'])
            {
                case 'fr':
                case 'français':
                    setcookie("lang","french", time() + 365*24*3600, null, null, false, true);
                    break;
                case 'en':
                case 'english':
                default:
                    setcookie("lang","english", time() + 365*24*3600, null, null, false, true);
                    break;
            }

            // Redirection because the cookie is accessible only after a reload
            header("Location: ".$_SERVER["PHP_SELF"]);
        }

        // Updating the Core Language value if is different
        if(isset($_COOKIE['lang']) && $_CORE['language'] != $_COOKIE['lang'])
            $_CORE['language'] = $_COOKIE['lang'];

        // Generate de Translation provider
        $lang = new Lang();
        $lang->setFile($_CORE['language'].'.ini');
    }
}