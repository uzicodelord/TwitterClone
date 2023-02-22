<?php

namespace App\Controller;

use App\BaseController;
use App\Model\LogOut;
class LogoutController extends BaseController
{
    public function index() {
        $logout = new LogOut('twitteruzi/index.php');
        $logout->destroySession();
    }
}

