<?php

use App\Controller\HomeController;

class Router
{
    protected $class;
    protected $method;

    public function __construct()
    {
        session_start();
        require './vendor/autoload.php';

        if (!isset($_SESSION['username'])) {
            header('location: Views/login.php');
            exit();
        }
        $path = $_SERVER['REQUEST_URI'];
        $base = "/twitteruzi/index.php";
        $path = str_replace($base, "", $path);
        list($class, $method) = explode("/", $path);
        $this->class = ucfirst($class);
        $this->method = substr($method, 0, strpos($method, "?"));

        if (empty($this->class)) {
            $this->class = HomeController::class;
        }
        if (empty($this->method)) {
            $this->method = 'index';
        }
    }

    public function run()
    {
        $class = new $this->class();
        echo $class->{$this->method}();
    }
}



$router = new Router();
$router->run();