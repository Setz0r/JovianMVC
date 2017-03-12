<?php

class Utility {

    private static $_db;

    public static function Initialize($db) {
        self::$_db = $db;
    }

    public static function genCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public static function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public static function parsePhone($innumber) {
        $number = preg_replace("/[^0-9]/", "", $innumber);
        if (strlen($number) == 10)
            return $number;
        if (strlen($number) == 11 && substr($number, 0, 1) == '1')
            return substr($number, 1);
        return NULL;
    }

    public static function getArrayNext(&$array, $curr_key) {
        $next = FALSE;
        reset($array);

        do {
            $tmp_key = key($array);
            $res = next($array);
        } while (($tmp_key != $curr_key) && $res);

        if ($res) {
            $next = key($array);
        }

        return $next;
    }

    public static function curl_request($user, $password, $url, $postdata = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
    
}

?>
