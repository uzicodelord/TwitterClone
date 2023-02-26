<?php

namespace App\Controller;
use App\BaseController;
use App\Model\SignUpAndSignIn;

class SignupController extends BaseController
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
        $this->view('signup.twig', ['RegStatus' => $RegStatus]);
        include "Resources/views/lsfooter.twig";
    }

    public function signup()
    {
        $signup = new SignUpAndSignIn();
        $signup->signUp();
    }
}