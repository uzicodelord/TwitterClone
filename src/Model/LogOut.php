<?php

namespace App\Model;

class LogOut
{

    public function destroySession(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /twitteruzi/index.php/login/index');
    }
}
