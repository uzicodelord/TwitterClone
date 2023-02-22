<?php

namespace App\Model;

class ProfileUpdater extends Database
{

    public function updateProfile($email, $password = '')
    {
        $email = $this->formatData($email);
        $username = $_SESSION['username'];

        if (empty($password)) {
            $sql = "UPDATE users SET email='$email' WHERE username='$username'";
            $this->Conn->query($sql);
        } else {
            $password = $this->formatData($password);
            $sql = "UPDATE users SET password='$password', email='$email' WHERE username='$username'";
            $this->Conn->query($sql);
            $_SESSION['email'] = $email;
        }
    }

    private function formatData($data): string
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return trim($data);
    }
}
