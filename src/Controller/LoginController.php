<?php

namespace App\Controller;
use App\Model\Request;
use App\Model\SignUpAndSignIn;

class LoginController
{
public function index()
    {
    $login = new SignUpAndSignIn();
    $RegStatus = $login->getRegStatus();
    $LoginStatus = $login->getLoginStatus();
        include "Views/lsheader.php";
        include "Views/login.php";
        include "Views/lsfooter.php";
    }

    public function login()
    {
        $user = new SignUpAndSignIn();
        $user->signIn();
    }

    private function formatData($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

}