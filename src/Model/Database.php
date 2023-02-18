<?php

namespace App\Model;

use mysqli;

class Database
{
    private $serverName;
    private $username;
    private $password;
    private $databaseName;
    protected $Conn;

    public function __construct()
    {
        $this->serverName = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->databaseName = 'twitteruzi';
        $this->Conn = new mysqli($this->serverName, $this->username, $this->password, $this->databaseName);

        if ($this->Conn->connect_error) {
            die($this->Conn->connect_error);
        }
    }
}