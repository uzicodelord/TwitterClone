<?php

namespace App;

class Router
{
    protected $class;
    protected $method;

    public function __construct()
    {
        session_start();
        $path = $_SERVER['REQUEST_URI'];
        $base = "/twitteruzi/index.php";
        $path = str_replace($base, "", $path);
        list($class, $method) = explode("/", $path);
        $this->class = "App\\Controllers\\" . ucfirst($class) . "Controller";
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
        $class = $this->class();
        echo $class->{$this->method}();
    }
}
