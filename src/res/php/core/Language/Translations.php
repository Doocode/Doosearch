<?php

// res/php/Language/Translations.php

namespace Language;

use Language\Lang;

class Translations
{
    public static function init()
    {
        // We will use these following global variables
        global $_APP;
        
        // If we have this GET argument
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

        // Updating the Core Language value if it is different
        if(isset($_COOKIE['lang']) && $_APP['language'] != $_COOKIE['lang'])
            $_APP['language'] = $_COOKIE['lang'];

        // Generate de Translation provider
        Lang::init();
        Lang::setFile($_APP['language'].'.ini');
    }
}