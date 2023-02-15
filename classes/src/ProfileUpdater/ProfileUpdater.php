<?php

namespace ProfileUpdater;
class ProfileUpdater
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateProfile($email, $password = '')
    {
        $email = $this->formatData($email);
        $username = $_SESSION['username'];

        if (empty($password)) {
            $sql = "UPDATE users SET email='$email' WHERE username='$username'";
            $this->conn->query($sql);
            echo "<center><div class='alert alert-success alert-dismissable' style='width:70%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Profile Was Updated Successfully..</div></center>";
        } else {
            $password = $this->formatData($password);
            $sql = "UPDATE users SET password='$password', email='$email' WHERE username='$username'";
            $this->conn->query($sql);
            echo "<center><div class='alert alert-success alert-dismissable' style='width:70%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Profile Was Updated Successfully..</div></center>";
            $_SESSION['email'] = $email;
        }
    }

    private function formatData($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
}
?>