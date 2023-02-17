<?php

namespace App\Model;

class User extends Database
{
    protected $username;
    protected $email;
    protected $reg_date;

    public function __construct($userToView)
    {
        parent::__construct();
        $this->getDetails($userToView);
    }

    private function getDetails($userToView)
    {
        $sql = "SELECT * FROM users WHERE username='$userToView'";
        $result = $this->Conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->reg_date = $row['reg_date'];
            }
        } else {
            // Handle case where no results were found
            $this->username = '';
            $this->email = '';
            $this->reg_date = '';
        }
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRegDate(){
        return $this->reg_date;
    }
}
