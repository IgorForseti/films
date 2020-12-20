<?php
error_reporting(-1);
//require "Router.php";

define('ROOT', __DIR__);
define('APP', __DIR__ . "/app/");
define('VIEW', __DIR__ . "/app/view/");
define('LAYOUTS', __DIR__ . "/app/view/layouts/");
define('IMPORT', __DIR__ . "/uploads/");


spl_autoload_register(function ($class) {
//    $file = "$class.php";
    $file = ROOT . "/" . str_replace("\\", "/", $class). ".php";
//    var_dump("<pre>" . $file . "</pre>");
//        var_dump("spl_autoload_register => " . $file);
    if (is_file($file)) {
        require_once $file;
        return true;
    }
    return false;
});

$query = trim($_SERVER['REQUEST_URI'],'/');
Router::dispatch($query);
//if(Router::matchRoute($query)) {
//    var_dump("<pre>" . Router::getRoute() . "</pre>");
//} else {
//    include "view/404.php";
//}

