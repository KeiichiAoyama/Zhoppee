<?php
namespace App\Tools;

class Cookie{
    public static function set($name, $value, $expiry){
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
          }
          return false;
    }

    public static function get($name){
        return $_COOKIE[$name];
    }

    public static function delete($name){
        self::set($name, '', time()-1);
    }
}