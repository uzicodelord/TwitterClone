<?php
class Registration
{
    private $txtUsername = "";
    private $txtPassword = "";
    private $txtEmail = "";
    private $txtPasswordErr = "";
    private $txtEmailErr = "";
    private $passwordIsset = false;
    private $emailIsset = false;

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (strlen($_POST['txtPassword']) < 6) {
                $this->txtPasswordErr = "Password must be at least 6 characters long";
            } else {
                $this->txtPasswordErr = "";
            }
            if (!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)) {
                $this->txtEmailErr = "Invalid Email Address";
            } else {
                $this->txtEmailErr = "";
                $this->emailIsset = true;
                $this->txtEmail = $this->formatData($_POST['txtEmail']);
            }

            if ($this->passwordIsset == true && $this->emailIsset == true) {
                $this->txtUsername = $this->txtPassword = $this->txtEmail = "";
                $this->txtPasswordErr = $this->txtEmailErr = "";
            }
        }
    }

    private function formatData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$registration = new Registration();
$registration->formatData($data);

?>