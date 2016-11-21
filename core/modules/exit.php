<?php
/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 21.11.16
 * Time: 14:50
 */
include '../../config.php';
include '../controllers/DB.php';
include '../controllers/Users.php';
include '../controllers/Auth.php';


if (isset($_POST['post'])){

    if (Auth::logOut()) header('Location: /'.$lang);
}