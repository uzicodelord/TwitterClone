<?php

use App\Router;

if (!isset($_SESSION['username'])) {
    header('location: Views/login.php');
    exit();
}

$router = new Router();
$router->run();