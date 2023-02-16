<?php
require './vendor/autoload.php';
session_start();
$path = $_SERVER['REQUEST_URI'];
$base = "/twitteruzi/route.php";
$path = str_replace("/twitteruzi/route.php", "", $path);
$path = explode("/", $path);
$class = ucfirst($path[1]);
$method = $path[2];
$method = explode("?", $method);
$class = "App\\Controller\\" . $class . "Controller";
$class = new $class();
echo $class->{$method[0]}();
?>