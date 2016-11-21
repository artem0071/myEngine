<?php
/**
 * Created by PhpStorm.
 * User: artemdegtarev
 * Date: 20.11.16
 * Time: 14:11
 */

include 'config.php';

spl_autoload_register(function ($class_name) {
    include CONTROLLERS. $class_name . '.php';
});

$user = new Users();

$rout = new Router($_SERVER['REQUEST_URI']);

$app = new App($rout,$user);


var_dump($rout);
echo '<br/>';
echo '<br/>';
var_dump($user);
echo '<br/>';
echo '<br/>';
var_dump($app);
echo '<br/>';
echo '<br/>';

$app->render();