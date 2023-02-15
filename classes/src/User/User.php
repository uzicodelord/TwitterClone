<?php

namespace User;
class User
{
    protected $username;
    protected $email;
    protected $reg_date;

    public function __construct($userToView)
    {
        $this->getDetails($userToView);
    }

    private function getDetails($userToView)
    {
        require_once 'database/dbConfig.php';
        global $Conn;
        $sql = "SELECT * FROM users WHERE username='$userToView'";
        $result = $Conn->query($sql);
        while($row = $result->fetch_assoc()){
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->reg_date = $row['reg_date'];
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
?>