<?php
require './vendor/autoload.php';
session_start();
header('location: Views/login.php');
if (isset($_SESSION['username'])) {
    header('location: Views/home.php');
}


