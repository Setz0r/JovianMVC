<?php
//Setup our automatic class loading
function __autoload($class_name) {
    if (file_exists('inc/class.' . strtolower($class_name) . '.php')) {
        include 'inc/class.' . strtolower($class_name) . '.php';
    } else
        if (file_exists('models/'.strtolower($class_name).'.php')) {
            include 'models/'.strtolower($class_name).'.php';
        }        
}

//Site Configuration
define('SITE_NAME','Jovian MVC');
define('SITE_VERSION','1.0.0');

//Our Default Controller
define('CONTROLLER_DEFAULT','home');

//Database Config

//no database debugging
define('DISPLAY_DEBUG',false);

//Local Dev DB
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');

$DB = new DB();
Config::set('db',$DB);

//set default timezone
date_default_timezone_set('America/Chicago');

//Environment
Config::set('base_url','http://mysite.local/');
Config::set('sitecookie','jovianmvc');

//Preinitialize

//Setup routes
Router::Initialize();

//Initialize the Utilities
Utility::Initialize($DB);


?>