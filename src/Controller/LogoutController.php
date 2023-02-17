<?php

namespace App\Controller;

use App\Model\LogOut;
class LogoutController
{
    public function logout() {
        $logout = new LogOut('/twitteruzi/index.php');
        $logout->destroySession();
    }
}