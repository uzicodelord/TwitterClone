<?php

namespace App\Model;

use mysqli;

class Database
{
    private string $serverName;
    private string $username;

    private string $password;
    private string $databaseName;
    protected mysqli $Conn;

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