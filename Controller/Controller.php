<?php
namespace App\Controller;

require_once __DIR__ . '/../Lib/database.php';
require_once __DIR__ . '/../Lib/cookies.php';

use App\Tools\DB;
use App\Tools\Cookie;

class Controller{
    public function checkUsername($username){
        $db = DB::getInstance();
        $where = array('username', '=', $username);
        if(count($db->select('username', 'users', $where)->getResult()) > 0){
            return true;
        }
        return false;
    }
    
    public function checkPassword($password, $username){
        $db = DB::getInstance();
        $where = array('username', '=', $username);
        $users = $db->select('password', 'users', $where)->getResult();
        $hash = $users[0]->password;
        if(password_verify($password, $hash)){
            return true;
        }
        return false;
    }
    
    public function setCookieUsername($username){
        $cookie = new Cookie();
        if($cookie->set('username', $username, 7*24*60*60)){
            return true;
        }
        return false;
    }
    
    public static function getRowProducts($type){
        if(is_int($type)){
            $db = DB::getInstance();
            switch($type){
                case 1:
                    $db = $db->select('*', 'manga');
                    break;
                case 2:
                    $db = $db->select('*', '`light novel`');
                    break;
                case 3:
                    $db = $db->select('*', 'merch');
                    break;
            }
            if($db){
                return $db->getResult();
            }
        }
        return false;
    }

    public static function registerNewUser($user = array()){
        $db = DB::getInstance();
        if(is_array($user) && count($user) > 0){
            $fields = array('username', 'password', 'Full_Name', 'email', 'phone', 'address', 'city', 'zip', 'cardnumber');
            $assoc_fields = array_combine($fields, $user);
            if($db->insert('users', $assoc_fields)){
                return true;
            }
        }
        return false;
    }
}






