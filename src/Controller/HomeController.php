<?php
namespace App\Controller;

class HomeController{
    public function index(){
        $name = 'uzi';
        include 'Views/home.php';
    }
}

?>