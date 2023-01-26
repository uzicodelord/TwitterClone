<?php
class SessionLogOut
{
    public function __construct($redirect_url) {
        
    }
    public function destroy()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}

$session = new SessionLogOut('index.php');
$session->destroy();

?>