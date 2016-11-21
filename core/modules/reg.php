<?php
/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 21.11.16
 * Time: 13:22
 */
include '../../config.php';
include '../controllers/DB.php';
include '../controllers/Users.php';
include '../controllers/Auth.php';


if (isset($_POST['post'])){
    
    if (isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['lang'])) {

        $lang = $_POST['lang'];
        $login = $_POST['name'];
        $pass = $_POST['pass'];

        if (Auth::userReg($login, $pass)) header('Location: /' .$lang. '/main');
        else header('Location: /'.$lang.'/reg');

    } else header('Location: /'.$lang.'/reg');
}