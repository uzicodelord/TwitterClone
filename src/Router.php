<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\LoginController;

class Router
{
    protected string $class;
    protected $method;

    public function __construct()
    {
        session_start();
        $path = $_SERVER['REQUEST_URI'];
        $path = str_replace("/twitteruzi/index.php/", "", $path);
        list($class, $method) = explode("/", $path);
        $this->class = "App\\Controller\\" . ucfirst($class) . "Controller";
        $this->method = substr($method, 0, strpos($method, "?"));
    }

    public function run()
    {
        if (!class_exists($this->class)) {
            $this->class = LoginController::class;
        }

        $class = new $this->class();

        if (empty($this->method)) {
            $this->method = 'index';
        }

        echo $class->{$this->method}();
    }
}
