<?php

/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 20.11.16
 * Time: 15:12
 */
class Users extends App
{
    /*
     * TYPES:
     * 0-4 -- нет доступа
     * 5-9 -- ограниченный доступ (*получают при входе в систему)
     * 10-19 -- менее ограниченный доступ  (*получают при регистрации)
     * 20-70 -- администрация/редакторы
     * 70-77 -- АДМИН
     */


    public $UserID;
    public $Login = 'Guest';
    public $Pass;
    public $Type = 5;
    
    public function __construct()
    {
        $login = (isset($_COOKIE['Login']) ? $_COOKIE['Login'] : null);
        $pass = (isset($_COOKIE['Pass']) ? $_COOKIE['Pass'] : null);

        $User = Auth::checkUser($login,$pass);

        if (count($User) == 1) {
            $User = $User[0];
            $this->UserID = $User['User_ID'];
            $this->Login = $User['User_Login'];
            $this->Pass = $User['User_Pass'];
        }
    }


}