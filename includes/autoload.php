<?php
include 'C:/xampp/htdocs/twitteruzi/database/dbconfig.php';
spl_autoload_register('AutoLoader');

function AutoLoader($classNames){
    $path = "./classes/src/";
    $extension = ".php";
    $fullpath = $path . $classNames . $extension;

    if (!file_exists($fullpath)){
        return false;
    }
    include_once $fullpath;
}