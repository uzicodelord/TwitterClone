<?php

namespace LogOut;

class LogOut
{
    private $redirectUrl;

    public function __construct($redirect_url) {
        $this->redirectUrl = $redirect_url;
    }

    public function destroySession(): void
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: '.$this->redirectUrl);
    }
}

$session = new LogOut('/twitteruzi/index.php');
$session->destroySession();

?>
