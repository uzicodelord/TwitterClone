<?php
namespace App;

use App\Controller\HomeController;

class Router
{
    protected $class;
    protected $method;

    public function __construct(){
        $path = $_SERVER['REQUEST_URI'];
        $path = str_replace("/twitteruzi/route.php/","",$path);

        list($class,$method)= explode("/",$path);

        $this->class = ucfirst($class);
        $this->method = substr($method, 0,strpos($method, "?"));

        if(empty($this->method)){
            $this->method = "index";
        }
    }

    public function run(){
        $class = new $this->class();
        echo $class->{$this->method}();
    }
}