<?php

class Router {
    private static $_data;
    private static $_getvars;
    
    public static function Initialize() {
        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
        
        self::$_getvars = array();
        
        for($i= 0;$i < sizeof($scriptName);$i++)
        {
            if ($requestURI[$i] == $scriptName[$i])
            {
                unset($requestURI[$i]);
            } else 
                if (strpos($requestURI[$i],'XDEBUG')) {
                    unset($requestURI[$i]);
                }
        }
        self::$_data = array_values($requestURI);
    }

    //turn get vars into associative array
    public static function setGetVars($getstr) {        
        parse_str($getstr,self::$_getvars);
    }
    
    public static function getGetVar($varname) {
        return (isset(self::$_getvars[$varname])) ? self::$_getvars[$varname] : NULL;
    }

    public static function getController() {
        if (count(self::$_data) > 0 && strlen(self::$_data[0])>0) {
            if (strpos(self::$_data[0],'?')) {
                $urlarray = explode('?',self::$_data[0]);
                self::setGetVars($urlarray[1]);   
                return $urlarray[0];
            } else {
                return self::$_data[0];
            }
        }
        return CONTROLLER_DEFAULT;
    }

    public static function loadMethod() {
        if (count(self::$_data) > 1) {
            if (strpos(self::$_data[1],'?')) {
                $urlarray = explode('?',self::$_data[1]);
                self::setGetVars($urlarray[1]);   
                return $urlarray[0];
            } else {
                return self::$_data[1];
            }
        }
        return false;
    }
    
    public static function loadParams() {
        $params = array();
        if (count(self::$_data) > 2) {
            $params = array_slice(self::$_data,2);
            if (strpos($params[count($params)-1],'?')) {
                $urlarray = explode('?', $params[count($params)-1]);
                $params[count($params)-1] = $urlarray[0];
                self::setGetVars($urlarray[1]);                  
            }
        }
        return $params;
    }
    
    public static function loadController($override = NULL) {
        $controller = ($override) ? $override : self::getController();
        if (strlen($controller) == 0) $controller = CONTROLLER_DEFAULT;
        if ($controller && file_exists("controllers/{$controller}.php")) {
            require_once("controllers/{$controller}.php");          
            $method = self::loadMethod();
            if ($method) {
                if (method_exists($controller,$method)) {
                    call_user_func_array(Array($controller,$method),self::loadParams());
                } else {
                    die('Invalid request.');
                }
            } else {
                call_user_func(Array($controller,'run'));
            }
        } else {
            die('Invalid request.');
        }
    }
    
    public static function Process($override = NULL) {   
        self::loadController($override);
    }
    
}