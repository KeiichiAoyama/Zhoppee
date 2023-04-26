<?php
namespace App\Tools;

class Session{
    public static function newSession(){
        session_start();
    }

    public static function set($name, $value){
        if($_SESSION[$name] = $value){
            return true;
        }
        return false;
    }

    public static function setArr($name){
        if($_SESSION[$name] = array()){
            return true;
        }
        return false;
    }

    public static function add($name, $value){
        if($_SESSION[$name][] = $value){
            return true;
        }
        return false;
    }

    public static function check($name){
        if (isset($_SESSION[$name])) {
            return true;
        }
        return false;
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public static function getArr($name, $i){
        return $_SESSION[$name][$i];
    }

    public static function change($name, $i, $value){
        if($_SESSION[$name][$i] = $value){
            return true;
        }
        return false;
    }

    public static function delete($name){
        if(self::set($name, "")){
            return true;
        }
        return false;
    }

    public static function endSession(){
        session_destroy();
    }
}