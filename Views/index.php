<?php
require './../vendor/autoload.php';
session_start();
header('location: login.php');
if (isset($_SESSION['username'])) {
    header('location: home.php');
}


