<?php
/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 21.11.16
 * Time: 14:12
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

//        var_dump(Auth::userLogin($login, $pass));

        if (Auth::userLogin($login, $pass)) header('Location: /' .$lang. '/main');
        else header('Location: /'.$lang.'/enter');

    } else header('Location: /'.$lang.'/enter');
}