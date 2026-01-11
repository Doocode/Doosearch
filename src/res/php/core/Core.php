<?php

// Source : https://www.grafikart.fr/forum/topics/15553

namespace Core;
use App\App;

define('DS', DIRECTORY_SEPARATOR); // meilleur portabilité sur les différents systeme.
define('ROOT', dirname(__FILE__).DS); // pour se simplifier la vie
//define('ROOT', $_SERVER[HTTP_HOST].DS.'p'.DS.'res'.DS.'php'.DS.'core'.DS); // pour se simplifier la vie

session_start();

require_once('Autoloader.php');
Autoloader::register();

new App();
