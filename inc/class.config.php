<?php

class Config {
    private static $_data;
    public static function get($var) {
        if (isset(self::$_data[$var])) {
            return self::$_data[$var];
        }
        return false;
    }
    public static function set($var,$value) {
        self::$_data[$var] = $value;
    }
    public static function push($var,$value) {
        if (!isset(self::$_data[$var])) {
            self::$_data[$var] = Array();
        }
        array_push(self::$_data[$var],$value);
    }
}


?>