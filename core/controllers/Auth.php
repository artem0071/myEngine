<?php

/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 21.11.16
 * Time: 12:09
 */
class Auth extends Users
{
    // проверка вошедшего пользователя
    public function checkUser($login, $pass){

        if (isset($login) && isset($pass)) {

            $user = self::checkUserBD($login, $pass); // получение юзера

            if (count($user) == 1){
                
                self::setUser($user[0]);
                return $user;
                
            } else{

                self::unsetUser();
            }

        } else{

            self::unsetUser();
        }
    }

    public function setUser($user){

        setcookie('Login', $user['User_Login'], time() + 3600*24*7, '/');
        setcookie('Pass', $user['User_Pass'], time() + 3600*24*7, '/');

        return true;
    }

    public function unsetUser(){
        setcookie('Login', '', -1, '/');
        setcookie('Pass', '', -1, '/');
    }
    
    // регистрация пользователя
    public static function userReg($login, $pass){
        
        if (!self::checkLogin($login)){

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            if (DB::insertDB('Users', ['User_Login','User_Pass'],[$login,$pass])){

                setcookie('Login', $login, time() + 3600*24*7, '/');
                setcookie('Pass', $pass, time() + 3600*24*7, '/');

                return true;
            } else return false;
        } else return false;
    }


    // Вход на сайт
    public static function userLogin($login, $pass){

        $user = DB::getResult("SELECT * FROM `Users` WHERE `User_Login` = '$login'");

        if (count($user) == 1){

            if (password_verify($pass, $user[0]['User_Pass'])) {
                self::setUser($user[0]);
                return true;
            }
            else return false;
        } else return false;

    }

    // Выход
    public static function logOut(){
        
        self::unsetUser();
        return true;
    }

    public function checkUserBD($login, $pass){

        $user = DB::getResult("SELECT * FROM `Users` WHERE `User_Login` = '$login' AND  `User_Pass` = '$pass'");
        return $user;

    }
    
    // проверка логина в базе
    public function checkLogin($login){

        $result = DB::getResult("SELECT `User_Login` FROM `Users` WHERE `User_Login` = '$login'");
        if (count($result) != 0) return true;
        else return false;

    }


    
    

}