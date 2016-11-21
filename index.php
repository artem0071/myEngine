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

$app = new App($_SERVER['REQUEST_URI']);

var_dump($app);
echo '<br/>';
echo '<br/>';

$app->render();