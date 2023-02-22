<?php

namespace App\Controller;
use App\Model\SignUpAndSignIn;

class SignupController
{
    public function index()
    {
        $loginsignup = new SignUpAndSignIn();
        $RegStatus = $loginsignup->getRegStatus();
        $txtEmail = $loginsignup->getTxtEmail();
        $txtEmailErr = $loginsignup->getTxtEmailErr();
        $txtUsername = $loginsignup->getTxtUsername();
        $txtUsernameErr = $loginsignup->getTxtUsernameErr();
        $txtPassword = $loginsignup->getTxtPassword();
        $txtPasswordErr = $loginsignup->getTxtPasswordErr();
        include "Views/lsheader.php";
        include "Views/signup.php";
        include "Views/lsfooter.php";
    }

    public function signup()
    {
        $signup = new SignUpAndSignIn();
        $signup->signUp();
    }
}