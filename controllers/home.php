<?php
class Home {
    
    public static function doView() {
        Config::push('scripts','views/home/home.js');
        require_once('views/home/home.php');
    }
    
    public static function run() {
        self::doView();
    }
}

?>