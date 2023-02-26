<?php

namespace App\Controller;
use App\BaseController;
use App\Model\SignUpAndSignIn;

class LoginController extends BaseController
{
public function index()
    {
    $login = new SignUpAndSignIn();
    $LoginStatus = $login->getLoginStatus();
        include "Resources/views/lsheader.twig";
        $this->view('login.twig', ['LoginStatus' => $LoginStatus]);
        include "Resources/views/lsfooter.twig";
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